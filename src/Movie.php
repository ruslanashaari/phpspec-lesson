<?php 

class Movie {

    protected $rating;

    protected $watched = false;

    protected $title;

    function __construct($title)
    {
        $this->title = $title;
    }

	public function watch()
    {
	   $this->watched = true;	
	}

    public function isWatched()
    {
        // TODO: write logic here
        return $this->watched;
    }

    public function setRating($rating)
    {
        // TODO: write logic here
        $this->validateRatingRange($rating);
            
        $this->rating = $rating;
    }

    public function getRating()
    {
        // TODO: write logic here
        return $this->rating;
    }

    protected function validateRatingRange($rating)
    {
        if($rating > 5)
            throw new InvalidArgumentException;
    }

    // public function setTitle($title)
    // {
    //     $this->title = $title;
    // }

    public function getTitle()
    {
        // TODO: write logic here
        return $this->title;
    }

}