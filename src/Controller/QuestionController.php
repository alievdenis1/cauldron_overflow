<?php


    namespace App\Controller;


    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Twig\Environment;
    use App\Service\MarkdownHelper;


    class QuestionController extends AbstractController
    {
        private $isDebug;

        public function __construct(bool $isDebug)
        {
            $this->isDebug = $isDebug;
        }
        /**
         * @Route("/", name="app_homepage")
         */
        public function homepage(Environment $twigEnvironment)
        {
            return $this->render('question/homepage.html.twig');
        }

        /**
         * @Route("/questions/{slug}", name="app_question_show")
         */
        public function show($slug,  MarkdownHelper $markdownHelper)
        {dump($this->isDebug);
            $answers = [
                'Make sure your cat is sitting `purrrfectly` still ?',
                'Honestly, I like furry shoes better than MY cat',
                'Maybe... try saying the spell backwards?',
            ];
            $questionText = 'I\'ve been turned into a cat, any thoughts on how to turn back? While I\'m **adorable**, I don\'t really care for cat food.';


            $parsedQuestionText = $markdownHelper->parse($questionText);

            return $this->render('question/show.html.twig', [
                'question' => ucwords(str_replace('-', ' ', $slug)),
                'answers' => $answers,
                'questionText' => $parsedQuestionText,
            ]);
        }


    }