<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-08
     * Time: 2:25 PM
     */
    require_once("Controllers\EditReferencesController.php");
    
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
        
        protected function setUp() {
            $this->ctrl = new EditReferencesController();
        }
        
        protected function genView($viewName, $model = null) {
            return new View($model, "C:\Users\antoi\Documents\School\Session 4\\420-4W5-GG\PHP-Final\Views\EditReferences\\$viewName" . "View.php");
        }
        
        protected function tearDown() {
            unset($this->ctrl);
        }
        
        public function testShowSessions() {
            $this->setUp();
            
        }
    }
