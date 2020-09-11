<?php
class Reply
{
    protected $index;

    public function __construct($index)
    {
        $this->index = $index;
    }
    public function replyComment()
    {
        return '<div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="heading' . $this->index . '">
                    <h2 class="mb-0">
                     <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" aria-expanded="false" data-target="#collapse_' . $this->index . '" aria-controls="collapse_' . $this->index . '">
                      Ответить
                    </button>
                    </h2>
                </div>
                <div id="collapse_' . $this->index . '" class="collapse" aria-labelledby="heading' . $this->index . '" data-parent="#accordionExample">
                    <div class="card-body">
                          <textarea required name="text" id="text_id' . $this->index . '" class="form-control"></textarea></br>
                          <input type="hidden" id="parent_id' . $this->index . '" class="parent_id" name="parent_id" value="' . $this->index . '">
                          <button id="' . $this->index . '" type="submit" class="btn btn-light">Отправить</button>

                    </div>
                </div>';
    }
}