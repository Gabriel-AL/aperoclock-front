<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @Entity @HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="App\Repository\AppUserRepository")
 */
class AppUser implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=60)
     */
    private $firstname;
    /**
     * @ORM\Column(type="string", length=60)
     */
    private $lastname;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastConnected;
  
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adress", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $adress;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AppGroup", inversedBy="appUsers")
     */
    private $appGroups;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", inversedBy="appUsers")
     */
    private $events;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;
   
    
    public function __construct()
    {
        $this->isAdmin = 0;
        $this->appGroups = new ArrayCollection();
        $this->events = new ArrayCollection();
       
        
    }


    /**
     * @ORM\PrePersist
     */
    public function setCreationDate()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt = new \DateTime;
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function setUpdateDate()
    {
        $this->updatedAt = new \DateTime;
    }  


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }
   
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    
    public function getPassword(): ?string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }
    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }
    public function getLastConnected(): ?\DateTimeInterface
    {
        return $this->lastConnected;
    }
    public function setLastConnected(\DateTimeInterface $lastConnected): self
    {
        $this->lastConnected = $lastConnected;
        return $this;
    }
    public function getAdress(): ?Adress
    {
        return $this->adress;
    }
    public function setAdress(?Adress $adress): self
    {
        $this->adress = $adress;
        return $this;
    }
    /**
     * @return Collection|AppGroup[]
     */
    public function getAppGroups(): Collection
    {
        return $this->appGroups;
    }
    public function addAppGroup(AppGroup $appGroup): self
    {
        // if (!$this->appGroups->contains($appGroup)) {
            $this->appGroups[] = $appGroup;
        // }
        return $this;
    }
    public function removeAppGroup(AppGroup $appGroup): self
    {
        if ($this->appGroups->contains($appGroup)) {
            $this->appGroups->removeElement($appGroup);
        }
        return $this;
    }
    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }
    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
        }
        return $this;
    }
    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
        }
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }


    //  USEFULL FOR JWT TOKEN
    public function getRoles()
    {
        return array('ROLE_USER');
    }
    public function eraseCredentials()
    {
    }
    public function getSalt()
    {
        return null;
    }
    
}