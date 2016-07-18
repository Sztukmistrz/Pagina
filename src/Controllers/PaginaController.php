<?php

namespace Sztukmistrz\Pagina\Controllers;

use App\Http\Controllers\Controller;
use Sztukmistrz\Navigator\Menus\BackendRealm;

use Doctrine\ORM\EntityManagerInterface;
use Sztukmistrz\Pagina\Entities\Page;

use Sztukmistrz\Pagina\Page\Manager;

use URL;
use EntityManager;
class PaginaController extends Controller
{

    private $baseRouteName = 'pagina.page.';

    private $baseViewName = 'layouter::backend.';

    private $realmName = 'pagina';

    /**
     * Funkcja startowa dla królestwa pagina
     * pokazuje menu królestwa dla zasobów
     * pokazuje ststystyki
     * pokazuje opis królestwa, instrukcje.
     * @return [type] [description]
     */
    public function start(BackendRealm $backendRealm)
    {
        # - - - - - - - - - - - - - - - - - - - - - - - -
        $menusRealm    = $backendRealm->getRealmMenu($this->realmName);
        $developerMenu = $backendRealm->getDeveloperMainMenu();
        $adminMenu     = $backendRealm->getAdminMainMenu();
        # - - - - - - - - - - - - - - - - - - - - - - - -

        # - - - - - - - - - - - - - - - - - - - - - - - -
        $ststistics    = 'stats pagina';
        $descriptions  = 'descriptions of Pagina';
        # - - - - - - - - - - - - - - - - - - - - - - - -

        # - - - - - - - - - - - - - - - - - - - - - - - -
        return view($this->baseViewName . __FUNCTION__,
            compact(
                'menusRealm', 'developerMenu', 'adminMenu',
                'ststistics', 'descriptions'
            )
        );
        # - - - - - - - - - - - - - - - - - - - - - - - -
    }



    /**
     * Zwraca stronę html całą
     * @param  Manager $men [description]
     * @return string       cała strona html
     */
    public function getPage(Manager $pageManager)
    {
        
        $contentData = $pageManager->getPage();

        $view =     $contentData[0]['view'];
        $layout =   $contentData[0]['layout'];
        $texts =    $contentData[0]['texts'];
        $pagesMenu = $contentData['pagesMenu'];
        $routeName = $contentData['routeName'];

        return view($view,
            compact(
                'layout',
                'texts',
                'pagesMenu',
                'routeName'
            )
        );

    }
}
