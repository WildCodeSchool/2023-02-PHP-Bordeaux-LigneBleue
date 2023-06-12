<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\Entity\Quiz;
use App\Entity\Sequence;
use App\Entity\Tag;
use App\Entity\Theme;
use App\Entity\Tutorial;
use App\Entity\User;
use App\Entity\UserTutorial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager,): void
    {
        $themes = $this->createThemesFixtures($manager, 12);
        $tutorials = $this->createTutorialsFixtures($manager, $themes, 2);
        $this->createSequencesFixtures($manager, $tutorials, 3);
        $quizzes = $this->createQuizFixture($manager, $tutorials);
        $this->createQuestionsFixtures($manager, $quizzes);
        $this->createTagsFixtures($manager, $tutorials);

        $users = $this->createUsersFixtures($manager, 3);
        // Le nombre de tutoriels par users peut faire buguer la fonction,
        // relancez le d:f:l jusqu'à que ça marche.
        $this->createUsersTutorialsFixtures($manager, $users, $tutorials, 1);

        $manager->flush();
    }

    private function createUsersFixtures(ObjectManager $manager, int $numberOfUsers): array
    {
        $users = [];

        for ($i = 1; $i <= $numberOfUsers; $i++) {
            $userData = [
                "firstname" => $this->faker->firstName(),
                "lastname" => $this->faker->lastName(),
                "birthdate" => $this->faker->dateTime(),
                "gender" => rand(1, 2) == 1 ? "Femme" : "Homme",
                "email" => $this->faker->email(),
                "password" => "password",
                "country" => "France",
                "zipcode" => $this->faker->randomNumber(5, true),
                "level" => "débutant"
            ];

            $user = User::withData($userData);
            $manager->persist($user);
            $users[] = $user;
        }

        return $users;
    }

    private function createThemesFixtures(ObjectManager $manager, int $numberOfThemes): array
    {
        $themes = [];

        for ($i = 1; $i <= $numberOfThemes; $i++) {
            $themeData = [
                "title" => $this->faker->word(),
                "indexOrder" => $i,
                "iconPath" => "test/test.png"
            ];
            $theme = Theme::withData($themeData);
            $manager->persist($theme);
            $themes[] = $theme;
        }

        return $themes;
    }

    private function createTutorialsFixtures(ObjectManager $manager, array $themes, int $tutorialsPerThemes): array
    {
        $tutorials = [];

        foreach ($themes as $theme) {
            for ($i = 1; $i <= $tutorialsPerThemes; $i++) {
                $tutorialData = [
                    "title" => $this->faker->word(),
                    "objective" => $this->faker->sentence(),
                    "isPublished" => false,
                    "indexOrder" => $i,
                    "picturePath" => "test/test.png",
                    "iconPath" => "test/test.png"
                ];

                $tutorial = Tutorial::withData($tutorialData);
                $tutorial->setTheme($theme);

                $manager->persist($tutorial);
                $tutorials[] = $tutorial;
            }
        }

        return $tutorials;
    }

    private function createSequencesFixtures(ObjectManager $manager, array $tutorials, int $sequencesPerTutorial): array
    {
        $sequences = [];

        foreach ($tutorials as $tutorial) {
            for ($i = 1; $i <= $sequencesPerTutorial; $i++) {
                $sequenceData = [
                    "title" => $this->faker->word(),
                    "content" => $this->faker->paragraph(),
                    "exercice" => rand(1, 2) == 1 ? true : false,
                    "indexOrder" => $i,
                    "picturePath" => "test/test.png",
                    "videoPath" => "test/test.png"
                ];

                $sequence = Sequence::withData($sequenceData);
                $sequence->setTutorial($tutorial);

                $manager->persist($sequence);
                $sequences[] = $sequence;
            }
        }

        return $sequences;
    }

    private function createQuizFixture(ObjectManager $manager, array $tutorials): array
    {
        $quizzes = [];

        foreach ($tutorials as $tutorial) {
            $quizData = [
                "title" => $this->faker->word(),
                "questionsAmount" => rand(5, 10)
            ];

            $quiz = Quiz::withData($quizData);
            $quiz->setTutorial($tutorial);
            $manager->persist($quiz);
            $quizzes[] = $quiz;
        }

        return $quizzes;
    }

    private function createQuestionsFixtures(ObjectManager $manager, array $quizzes): array
    {
        $questions = [];

        foreach ($quizzes as $quiz) {
            for ($i = 1; $i <= $quiz->getQuestionsAmount(); $i++) {
                $questionData = [
                    "prompt" => $this->faker->sentence() . "?",
                    "proposition1" => $this->faker->sentence(),
                    "proposition2" => $this->faker->sentence(),
                    "proposition3" => $this->faker->sentence(),
                    "proposition4" => $this->faker->sentence(),
                    "answer" => "proposition" . rand(1, 4)
                ];

                $question = Question::withData($questionData);
                $question->setQuiz($quiz);
                $manager->persist($question);
                $questions[] = $question;
            }
        }

        return $questions;
    }

    private function createTagsFixtures(
        ObjectManager $manager,
        array $tutorials
    ): array {
        $levelTags = ["débutant", "intermédiaire", "avancé"];
        $tags = [];

        foreach ($levelTags as $levelTag) {
            $tag = Tag::withTitle($levelTag);
            $manager->persist($tag);
            $tags[] = $tag;
        }

        foreach ($tutorials as $tutorial) {
            $tutorial->addTag($tags[array_rand($tags)]);
        }

        return $tags;
    }

    public function createUsersTutorialsFixtures(
        ObjectManager $manager,
        array $users,
        array $tutorials,
        int $tutorialsPerUser
    ): array {
        $usersTutorials = [];

        foreach ($users as $user) {
            for ($i = 1; $i <= $tutorialsPerUser; $i++) {
                $usersTutorialsData = [
                    "user" => $user,
                    "tutorial" => $tutorials[array_rand($tutorials)],
                    "status" => rand(1, 2) == 1 ? true : false,
                    "favorite" => rand(1, 2) == 1 ? true : false
                ];

                $userTutorial = UserTutorial::withData($usersTutorialsData);

                $manager->persist($userTutorial);
                $usersTutorials[] = $userTutorial;
            }
        }

        return $usersTutorials;
    }
}
