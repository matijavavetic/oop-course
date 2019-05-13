<?php

class Paginate
{
    public $currentPage;
    public $itemsPerPage;
    public $itemsTotalCount;

    public function __construct($page=1, $itemsPerPage=4, $itemsTotalCount=0)
    {
        $this->currentPage = (int)$page;
        $this->itemsPerPage = (int)$itemsPerPage;
        $this->itemsTotalCount = (int)$itemsTotalCount;
    }

    public function next()
    {
        return $this->currentPage++;
    }

    public function previous()
    {
        return $this->currentPage--;
    }

    public function pageTotal()
    {
        return ceil($this->itemsTotalCount/$this->itemsPerPage);
    }

    public function hasPrevious()
    {
        return $this->previous() >= 1 ? true : false;
    }

    public function hasNext()
    {
        return $this->next() <= $this->pageTotal() ? true : false;
    }

    public function offset()
    {
        return ($this->currentPage -1) * $this->itemsPerPage;
    }
}