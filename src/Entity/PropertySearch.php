<?php
    namespace App\Entity;

    class PropertySearch
    {        
        /**
         * @var mixed
         */
        private $maxPrice;
        
        /**
         * @var mixed
         */
        private $minSurface;

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
            $this->min = $minSurface;
            return $this;
        }

    }
?>