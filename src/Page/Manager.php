<?php

namespace Sztukmistrz\Pagina\Page;

use Doctrine\ORM\EntityManagerInterface;
use Sztukmistrz\Pagina\Entities\Page;
use URL;
use View;
use Flash;

class Manager
{
    private $routeName;

    private $dbDataPage;

    private $layout;

    private $view;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Robi całą strinę html
     * @return [type] [description]
     */
    public function getPage()
    {
        $request = URL::getRequest();

        $this->routeName = $request->route()->getName();
//dd($request->route());
        $this->dbDataPage = $this->setDbDataPage($this->routeName);

        $this->setLayout();

        $this->setView();

        $pagesMenu = $this->getPagesMenuById($this->dbDataPage['id']);

        if ($this->view) {
            # szukamy pliku blade na dysku
            if (View::exists($this->view)) {
                return [$this->makeView($this->layout),'pagesMenu'=>$pagesMenu, 'routeName' => $this->routeName];
            } else {
                return 'No layout view exist';
            }

        }
        return false;
    }




    public function getPagesMenuById($id)
    {
        //$this->em->clear();
        $rep  = $this->em->getRepository('Sztukmistrz\Pagina\Entities\Page');
        $menu = $rep->getPagesMenuById($id);
        
        return $menu;
    }


    /**
     * Robi tablicę tekstów pomocy do stron
     * @return array    tablica wyników z DB
     */
    public function getHelpTextsForPage()
    {
        $request = URL::getRequest();

        $routeName = $request->route()->getName();

        $rep  = $this->em->getRepository('Sztukmistrz\Pagina\Entities\PageText');

        $helpTexts = $rep->getHelpTexts($routeName);
        
        return $helpTexts;
    }






    /**
     * [getTextsData description]
     * @return [type] [description]
     */
    public function getTextsData()
    {
    	$request = URL::getRequest();

        $routeName = $request->route()->getName();

        $rep  = $this->em->getRepository(Page::class);
        
        $dbDataPage = $rep->getPage($routeName);

        $pageTexts = $this->getTextsSimple($dbDataPage);

        return $pageTexts;
    }
    




    /**
     * [getTextsSimple description]
     * @param  [type] $dbDataPage [description]
     * @return [type]             [description]
     */
    private function getTextsSimple($dbDataPage)
    {

        if (!empty($dbDataPage[0]['pageText']) && $dbDataPage[0]['pageText']) {
            foreach ($dbDataPage[0]['pageText'] as $key => $arrT) {
                $texts[$arrT['pageTextType']['name']][$arrT['id']] = [
                    //'id'    => $arrT['id'],
                    'title' => $arrT['title'],
                    'text'  => $arrT['text'],
                    //'type'  => $arrT['pageTextType']['name'],
                    //'view'  => (!empty($arrT['view'])) ? $arrT['view']['name'] : false,
                 
                ];

            }
            return $texts;
        }
        return false;
    }



    /**
     * Upraszcza tablicę pageText
     * @return array
     */
    private function getTexts()
    {

        if (!empty($this->dbDataPage['pageText']) && $this->dbDataPage['pageText']) {
            foreach ($this->dbDataPage['pageText'] as $key => $arrT) {
                $texts[$arrT['id']] = [
                    'id'    => $arrT['id'],
                    'title' => $arrT['title'],
                    'text'  => $arrT['text'],
                    'type'  => $arrT['pageTextType']['name'],
                    'view'  => (!empty($arrT['view'])) ? $arrT['view']['name'] : false,
                ];

            }
            return $texts;
        }
        return false;
    }

    /**
     * Robi końcowe view dla page
     * @param  string $viewName
     * @return tablicę danych
     */
    private function makeView($viewName)
    {
        $textData = $this->getTexts();


        if ($textData && !empty($textData)) {
        
            foreach ($textData as $key => $textArr) {

                if ($textArr['view']) {
                    
                    $texts[$textArr['type']][] = view($textArr['view'],
                        [
                            'title' => $textArr['title'],
                            'text'  => $textArr['text'],
                        ]
                    )->render();

                }else{
                	$texts[$textArr['type']][] = [
                			'title' => $textArr['title'],
                            'text'  => $textArr['text'],
                	];
                }
            }
        }else{
            Flash::message('$textData is empty!?');
            $texts = false;
        }

        return ['layout'=>$this->layout, 'view'=>$this->view, 'texts'=>$texts];

    }

    /**
     * Ustawia view name dla strony
     */
    private function setView()
    {
    	$this->view = $this->dbDataPage['view']['name'];
    }

    public function getView($value='')
    {
    	return $this->view;
    }



    /**
     * [setLayout description]
     */
    private function setLayout()
    {
    	$this->layout = $this->dbDataPage['layout']['name'];
        // $this->layout = [
        //     'id'    => $this->dbDataPage['layout']['id'],
        //     'name'  => $this->dbDataPage['layout']['name'],
        //     'blade' => (!empty($this->dbDataPage['layout']['blade'])) ? $this->dbDataPage['layout']['blade'] : false,
        // ];
    }

    /**
     * [getLayout description]
     * @return [type] [description]
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * pobiera dane o stronie z DB
     * @param string $routeName Nazwa route
     */
    private function setDbDataPage($routeName)
    {
        $rep  = $this->em->getRepository(Page::class);
        
        $data = $rep->getPage($routeName);

        return $data[0];
    }

    /**
     * [getDbDataPage description]
     * @param  [type] $routeName [description]
     * @return [type]            [description]
     */
    public function getDbDataPage($routeName)
    {
        return $this->dbDataPage;
    }

}
