<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Repository\TransactionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionsRepository::class)]
class Transactions
{
    use CreatedAtTrait;


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Types $types = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Options $option_id = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;


    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Invoices $invoice = null;

    public function __construct()
    {
        $this->invoice = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getTypes(): ?Types
    {
        return $this->types;
    }

    public function setTypes(?Types $types): static
    {
        $this->types = $types;

        return $this;
    }

    public function getOptionId(): ?Options
    {
        return $this->option_id;
    }

    public function setOptionId(?Options $option_id): static
    {
        $this->option_id = $option_id;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getInvoice(): ?Invoices
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoices $invoice): static
    {
        $this->invoice = $invoice;

        return $this;
    }
}
