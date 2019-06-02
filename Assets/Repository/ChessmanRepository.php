<?php
    include_once(ROOT.'/Models/Chessman.php');
    class ChessmanRepository
    {
        public function getChessman($chessman) {
            $db = new Database();
            $res = $db->select("SELECT `id_chessman` FROM `Chessman` WHERE name='".$chessman."'");
            return $res;
        }
        public function getChessmanName($id) {
            $db = new Database();
            $res = $db->select("SELECT `name` FROM `Chessman` WHERE id_chessman='".$id."'");
            return $res->fetch_array()['name'];
        }
    }