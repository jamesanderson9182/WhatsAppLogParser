<?php

abstract class Page
{
    public function print(){
        $layout = new PageLayout();
        $layout->printTop();
        $this->printPageContents();
        $layout->printTail();
    }
    abstract protected function printPageContents();
}