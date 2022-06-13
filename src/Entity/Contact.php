<?php
    namespace App\Entity;
    use Symfony\Component\Validator\Constraints as Assert;
    
    class Contact {

        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 100)]
        private $firstname;

        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 100)]
        private $lastname;

        #[Assert\NotBlank]
        private $phone;

        #[Assert\NotBlank]
        #[Assert\Email]
        private $email;
        
        #[Assert\NotBlank]
        #[Assert\Length(min: 10)]
        private $message;

        private $property;

        /**
         * Get the value of message
         */ 
        public function getMessage()
        {
                return $this->message;
        }

        /**
         * Set the value of message
         *
         * @return  self
         */ 
        public function setMessage($message)
        {
                $this->message = $message;

                return $this;
        }

        /**
         * Get the value of phone
         */ 
        public function getPhone()
        {
                return $this->phone;
        }

        /**
         * Set the value of phone
         *
         * @return  self
         */ 
        public function setPhone($phone)
        {
                $this->phone = $phone;

                return $this;
        }

        /**
         * Get the value of lastname
         */ 
        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 
        public function setLastname($lastname)
        {
                $this->lastname = $lastname;

                return $this;
        }

        /**
         * Get the value of firstname
         */ 
        public function getFirstname()
        {
                return $this->firstname;
        }

        /**
         * Set the value of firstname
         *
         * @return  self
         */ 
        public function setFirstname($firstname)
        {
                $this->firstname = $firstname;

                return $this;
        }

        /**
         * Get the value of property
         */ 
        public function getProperty()
        {
                return $this->property;
        }

        /**
         * Set the value of property
         *
         * @return  self
         */ 
        public function setProperty($property)
        {
                $this->property = $property;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }
    }
?>