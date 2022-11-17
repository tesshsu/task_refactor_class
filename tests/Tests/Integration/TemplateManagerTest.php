<?php
namespace Tests\Integration;
use ApplicationContext;
use Destination;
use DestinationRepository;
use PHPUnit\Framework\TestCase;
use Quote;
use Template;
use TemplateManager;
use User;

class TemplateManagerTest extends TestCase
{
    /**
     * @var Quote
     */
    private $quote;
    /**
     * @var Destination
     */
    private $expectedDestination;

    /**
     * @var User
     */
    private $expectedUser;

    /**
     * Init the mocks
     */
    public function setUp(): void
    {
        $faker = \Faker\Factory::create();
        $destinationId = $faker->randomNumber();
        $this->quote = new Quote($faker->randomNumber(), $faker->randomNumber(), $destinationId, $faker->date());
        $this->expectedDestination = DestinationRepository::getInstance()->getById($destinationId);
        $this->expectedUser = ApplicationContext::getInstance()->getCurrentUser();
        $this->templateManager = new TemplateManager();
    }

    /**
     * Closes the mocks
     */
    public function tearDown(): void
    {
        unset($this->quote);
        unset($this->expectedDestination);
        unset($this->expectedUser);
        unset($this->templateManager);
    }

    /**
     * @test
     */
    public function test()
    {
        $template = new Template(
            1,
            'Votre livraison à [quote:destination_name]',
            "
                    Bonjour [user:first_name],                   
                    Merci de nous avoir contacté pour votre livraison à [quote:destination_name].                   
                    Bien cordialement,                  
                    L'équipe Convelio.com
                    ");
        $templateManager = new TemplateManager();

        $message = $templateManager->getTemplateComputed(
            $template,
            [
                'quote' => $this->quote
            ]
        );

        $this->assertEquals('Votre livraison à ' . $this->expectedDestination->getCountryName(), $message->getSubject());
        $this->assertEquals("
                    Bonjour " . $this->expectedUser->getFirstName() . ",
                    
                    Merci de nous avoir contacté pour votre livraison à " .  $this->expectedDestination->getCountryName() . ".
                    
                    Bien cordialement,
                    
                    L'équipe Convelio.com
                    ", $message->content);
    }
}
