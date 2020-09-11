<?php
class Comment{
    protected $text;
    protected $parent_id;
    protected $authorid;
    protected $db;
    public function __construct($db, $text, $parent_id, $author_id)
    {
        $this->db = $db;
        $this->text = $text;
        $this->parent_id = $parent_id;
        $this->authorid = $author_id;
    }
}