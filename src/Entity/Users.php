<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
// un utilisateur peut être identifié par l'email qui doit être unique
#[UniqueEntity(['email'], message :'Cet email existe déjà.')]

class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    use CreatedAtTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    // Un email unique par compte
    #[ORM\Column(length: 255, unique:true)]

    // Email doit être valide
    // value = valeur inséré par l'utilisateur
    #[Assert\Email(message: 'Email {{ value }} est invalide')]

    private ?string $email = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private ?array $roles = ['ROLE_USER'];

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $active = 0;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;


    #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'user_id')]
    private Collection $goals;

    #[ORM\OneToMany(targetEntity: Incomes::class, mappedBy: 'user_id')]
    private Collection $incomes;

    #[ORM\OneToMany(targetEntity: Savings::class, mappedBy: 'user_id')]
    private Collection $savings;

    #[ORM\OneToMany(targetEntity: Transactions::class, mappedBy: 'user')]
    private Collection $transactions;

    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->incomes = new ArrayCollection();
        $this->savings = new ArrayCollection();
        $this->transactions = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(int $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): static
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return Collection<int, Goal>
     */
    public function getGoals(): Collection
    {
        return $this->goals;
    }

    public function addGoal(Goal $goal): static
    {
        if (!$this->goals->contains($goal)) {
            $this->goals->add($goal);
            $goal->setUserId($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): static
    {
        if ($this->goals->removeElement($goal)) {
            // set the owning side to null (unless already changed)
            if ($goal->getUserId() === $this) {
                $goal->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Incomes>
     */
    public function getIncomes(): Collection
    {
        return $this->incomes;
    }

    public function addIncome(Incomes $income): static
    {
        if (!$this->incomes->contains($income)) {
            $this->incomes->add($income);
            $income->setUserId($this);
        }

        return $this;
    }

    public function removeIncome(Incomes $income): static
    {
        if ($this->incomes->removeElement($income)) {
            // set the owning side to null (unless already changed)
            if ($income->getUserId() === $this) {
                $income->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Savings>
     */
    public function getSavings(): Collection
    {
        return $this->savings;
    }

    public function addSaving(Savings $saving): static
    {
        if (!$this->savings->contains($saving)) {
            $this->savings->add($saving);
            $saving->setUserId($this);
        }

        return $this;
    }

    public function removeSaving(Savings $saving): static
    {
        if ($this->savings->removeElement($saving)) {
            // set the owning side to null (unless already changed)
            if ($saving->getUserId() === $this) {
                $saving->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transactions>
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transactions $transaction): static
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions->add($transaction);
            $transaction->setUser($this);
        }

        return $this;
    }

    public function removeTransaction(Transactions $transaction): static
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getUser() === $this) {
                $transaction->setUser(null);
            }
        }

        return $this;
    }




}
