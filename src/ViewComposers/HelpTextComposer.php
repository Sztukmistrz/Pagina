<?php
namespace Sztukmistrz\Pagina\ViewComposers;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\View\View;
use Sztukmistrz\Pagina\Page\Manager;

class HelpTextComposer
{

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(EntityManagerInterface $em, Manager $pageManager)
    {
        // Dependencies automatically resolved by service container...
        $this->em          = $em;
        $this->pageManager = $pageManager;

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $pageHelpTexts = $this->pageManager->getHelpTextsForPage();

        $view->with('pageHelpTexts', $pageHelpTexts);
    }

}
