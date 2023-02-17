<?php


class MySQL
{


    private $link, $table;

    public function __construct($link, $table)
    {

        $this->link = $link;
        $this->table = $table;


    }

    private function query($query)
    {

        $result = mysqli_query($this->link, $query);
        return $result;

    }

    private function fetchAllRows($result)
    {

        while ($row = mysqli_fetch_assoc($result)) {
            @$results[] = $row;
        }
        return $results;
    }

    public function getDetailsRegistration()
    {
        $query = "SELECT * FROM `drpciv`.`data` where `rezervare`=0 limit 1";
        $result = $this->query($query);
        $results = $this->fetchAllRows($result);
        return $results;

    }

    public function updateDetailsRegistration($id)
    {
        $query = "UPDATE `drpciv`.`data` set `rezervare`=1 where `id`=$id";
        echo $query."\n";
        $this->query($query);


    }

    public function close_mysql()
    {

        mysqli_close($this->link);
    }
}


?>