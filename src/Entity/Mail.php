<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Mail
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     * @Assert\NotBlank
     */
    protected $content;

    /** @var \DateTime */
    protected $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /** @return string */
    public function getEmail()
    {
        return $this->email;
    }

    /** @param string $email
     * @return string
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /** @return string */
    public function getPhone()
    {
        return $this->phone;
    }

    /** @param string $phone
     * @return string
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /** @return string */
    public function getContent()
    {
        return $this->content;
    }

    /** @param string $content
     * @return string
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /** @return \DateTime */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        if (empty($this->getPhone()) && empty($this->getPhone())) {
            $context->buildViolation('Jedno z pól kontaktowych musi zostać wypełnione!')
                ->atPath('email')
                ->addViolation();
        }
        if (empty($this->getPhone()) && empty($this->getPhone())) {
            $context->buildViolation('')
                ->atPath('phone')
                ->addViolation();
        }
    }
}