<?php
declare(strict_types=1);

namespace App\Services;


use App\Entity\Portfolio;
use App\Form\PortfolioType;
use App\Repository\PortfolioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetterPortfolioService
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var PortfolioRepository
     */
    private $portfolioRepository;
    /**
     * @var TwitterApiService
     */
    private $twitterApi;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        FormFactoryInterface $formFactory,
        Environment $twig,
        PortfolioRepository $portfolioRepository,
        TwitterApiService $twitterApi,
        EntityManagerInterface $entityManager
    )
    {
        $this->formFactory = $formFactory;
        $this->twig = $twig;
        $this->portfolioRepository = $portfolioRepository;
        $this->twitterApi = $twitterApi;
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $twitterName
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws \Exception
     */
    public function getProfile(string $twitterName): Response
    {
        $portfolio = $this->portfolioRepository->findOneBy(['twitterUserName' => $twitterName]);
        if (is_null($portfolio)) {
            $portfolio = $this->newPortfolio($twitterName);
        }

        // Has information about that profile
        if (!$portfolio->getSetData()) {
            $tweet = $this->twitterApi->getTweets($portfolio->getTwitterUserName(), 1);
            if (count($tweet) != 0) {
                $this->setDataProfile($portfolio, $tweet);
            } else {
                throw new \Exception('Tweets no found', 404);
            }
        }

        $form = $this->formFactory->create(PortfolioType::class, $portfolio);

        return $this->renderView('profile.html.twig', [
            'portfolio' => $portfolio,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Portfolio $portfolio
     * @param array $tweet
     */
    public function setDataProfile(Portfolio $portfolio, array $tweet): void
    {
        $infoTweet = current($tweet);

        $portfolio->setName($infoTweet->user->name);
        $portfolio->setTitle('About me');
        $portfolio->setDescription($infoTweet->user->description);
        $portfolio->setImageUrl($infoTweet->user->profile_image_url);
        $portfolio->setSetData(true);

        $this->entityManager->persist($portfolio);
        $this->entityManager->flush();
    }

    /**
     * @param string $twitterUserName
     * @return Portfolio
     */
    public function newPortfolio(string $twitterUserName): Portfolio
    {
        $newPortfolio = new Portfolio();
        $newPortfolio->setTwitterUserName($twitterUserName);
        $this->entityManager->persist($newPortfolio);
        $this->entityManager->flush();

        return $newPortfolio;
    }

    /**
     * @param string $twig
     * @param array $parameters
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    private function renderView(string $twig, array $parameters): Response
    {
        $content = $this->twig->render($twig, $parameters);
        $response = new Response();
        $response->setContent($content);

        return $response;
    }
}