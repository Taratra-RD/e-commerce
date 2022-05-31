<?php
    namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

    class PropertySearch
    {        
        /**
         * @var mixed
         */
        private $maxPrice;


        /**
         * @var mixed
         */
        #[Assert\Range(min: 10, max: 400,  notInRangeMessage: 'la recherche doivent être entre {{ min }} m2 et {{ max }} m2')]
        private $minSurface;
        
        /**
         * @var ArrayCollection
         */
        private $options;

        public function __construct()
        {
            $this->options = new ArrayCollection();
        }

        public function getMaxPrice():?int
        {
            return $this->maxPrice;
        }
        
        public function setMaxPrice(int $maxPrice): PropertySearch
        {
            $this->maxPrice = $maxPrice;
            return $this;
        }

        public function getMinSurface():?int
        {
            return $this->minSurface;
        }
        
        public function setMinSurface(int $minSurface): PropertySearch
        {
            $this->minSurface = $minSurface;
            return $this;
        }

        public function getOptions():?ArrayCollection
        {
            return $this->options;
        }
        
        public function setOptions(int $options): PropertySearch
        {
            $this->options = $options;
            return $this;
        }

    }
?>