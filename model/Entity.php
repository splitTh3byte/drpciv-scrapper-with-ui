<?php


class Entity
{


    private $link, $table;

    public function __construct($link,$table)
    {

        $this->link = $link;
        $this->table=$table;


    }

    private function query($query)
    {

        $result = mysqli_query($this->link, $query);


        return $result;

    }

    private function FetchAll($result)
    {

        while ($row = mysqli_fetch_assoc($result)) {

            $results[] = $row;
        }
        return $results;
    }

    public function getData(){
        $query="SELECT * FROM `drpciv`.`data`;";
        $result=$this->query($query);
        $results=$this->FetchAll($result);
        return $results;
    }


}