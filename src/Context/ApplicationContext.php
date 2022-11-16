<?php

class ApplicationContext
{
    use SingletonTrait;

    /**
     * @var Site
     */
    private $currentSite;
    /**
     * @var User
     */
    private $currentUser;

    protected function __construct()
    {
        $faker = \Faker\Factory::create();
        $this->currentSite = new Site($faker->randomNumber(), $faker->url);
        $this->currentUser = new User($faker->randomNumber(), $faker->firstName, $faker->lastName, $faker->email);
    }

    /**
     * @return Site
     */
    public function getCurrentSite(): Site
    {
        return $this->currentSite;
    }

    /**
     * @return User
     */
    public function getCurrentUser(): User
    {
        return $this->currentUser;
    }
}
