<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-08
     * Time: 2:25 PM
     */
    require_once("Controllers/EditReferencesController.php");
    
    class EditReferencesTest extends PHPUnit_Framework_TestCase {
        /**@var EditReferencesController $ctrl */
        protected $ctrl;
        
        public function testFirstPage() {
            $this->setUp();
            $expected = $this->genView("EditReferences");
            $actual = $this->ctrl->EditReferences();
            $this->assertEquals($expected, $actual);
            $this->tearDown();
        }
    
        public function testShowSessions() {
            $this->setUp();
            $arrSessions = array();
        
            $this->getMockClass(Session::class);
            for ($i = 0; $i < 20; $i++) {
                $arrSessions[] = $this->genRandomSessions($i);
            }
            $posts = [
                "donneesSession" => json_encode($arrSessions)
            ];
            makeJSONPosts($posts);
            $view = $this->ctrl->confirmerSessions();
            $this->assertEquals($view->getModel(), $arrSessions);
            $this->tearDown();
        }
    
        protected function genRandomSessions($seed) {
            $jour = rand(10, 28);
            $mois = [
                1,
                6,
                8
            ];
            $saisons = [
                "H",
                "E",
                "A"
            ];
            $annee = 2000 + $seed % 3;
        
            $obj = $this->getMockBuilder("Session")
                ->disableOriginalConstructor()
                ->getMock();
            $obj->description = $saisons[$seed % 3] . $annee;
            $obj->dateDebut = $annee . "-" . $mois[$seed % 3] . "-" . $jour;
            $obj->dateFin = $annee . "-" . substr(('0' . ($mois[$seed % 3] + 3)), -2, 2) . "-" . $jour;
            $obj->modelState = 0;
            return $obj;
        }
        
        protected function setUp() {
            $this->ctrl = new EditReferencesController();
        }
        
        protected function genView($viewName, $model = null) {
            return new View($model, "C:\Users\antoi\Documents\School\Session 4\\420-4W5-GG\PHP-Final\Views\EditReferences\\$viewName" . "View.php");
        }
        
        protected function tearDown() {
            unset($this->ctrl);
        }
    }
