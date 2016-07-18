<?php

namespace Sztukmistrz\Pagina\Controllers;

use App\Http\Controllers\Controller;


//use Doctrine\ORM\EntityManagerInterface;
//use Sztukmistrz\Pagina\Entities\Page;

//use Sztukmistrz\Pagina\Page\Manager;

use URL;

class StartPageController extends Controller
{
	/**
	 * [start description]
	 * @return [type] [description]
	 */
	public function start()
    {	
    	// tutaj zdefiniujemy wszystkie ważne elementy startowej strony serwisu.
    	// pokażemy nową wystawę
    	// pokażę listę blogów
    	// pokażemy reklamy
    	// co jeszcze?
    	return view('start');
    }
    

    public function welcome()
    {   

        // tutaj zdefiniujemy wszystkie ważne elementy startowej strony serwisu.
        // pokażemy nową wystawę
        // pokażę listę blogów
        // pokażemy reklamy
        // co jeszcze?
        return view('welcome');
    }

}