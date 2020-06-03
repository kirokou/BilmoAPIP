<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Hateoas\Configuration\Annotation\Exclusion;
use Hateoas\Configuration\Annotation as Hateoas;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="Cet utilisateur existe déjà.")
 * @ORM\HasLifecycleCallbacks
 * 
 * @ApiResource(
 *      normalizationContext={
 *         "groups"={"user:read"}
 *      },
 *      
 *      denormalizationContext={
 *         "groups"={"user:write"}
 *      },
 * 
 *       collectionOperations={
 *           "GET"={
 *                "normalization_context"={"groups"={"user:list"}} 
 *            },
 *           "POST",
 *       },
 *       itemOperations={
 *           "GET"={},
 *           "PUT"={},
 *           "DELETE"={},
 *       },
 * )
 * 
 * @ApiFilter(
 *      SearchFilter::class, 
 *      properties={
 *          "lastname": "partial", 
 *          "firstname": "partial",
 *      })
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user:read","user:list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","user:list","user:write"})
     * @Assert\NotBlank(message="Ce champs ne peut être vide.")
     * @Assert\Length(min="5", max="255",
     *   minMessage="Ce champ doit être supérieur ou égale à {{ limit }}.",
     *   maxMessage="Ce champ doit être inférieur ou égale à {{ limit }}."
     * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","user:list","user:write"})
     * @Assert\NotBlank(message="Ce champs ne peut être vide.")
     * @Assert\Length(min="5", max="255",
     *   minMessage="Ce champ doit être supérieur ou égale à {{ limit }}.",
     *   maxMessage="Ce champ doit être inférieur ou égale à {{ limit }}."
     * )
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","user:list","user:write"})
     * @Assert\NotBlank(message="Ce champs ne peut être vide.")
     * @Assert\Email(message="Le format de l'email est incorrect")
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user:read","user:list","user:write"})
     */
    private $client;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"user:read","user:list"})
     */
    private $createdAt;

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /*
    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    */

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }
}
