<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Hateoas\Configuration\Annotation\Exclusion;
use Hateoas\Configuration\Annotation as Hateoas;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @UniqueEntity(fields={"reference"}, message="Ce produit existe déjà.")
 * 
 * @ApiResource(
 *      normalizationContext={
 *         "groups"={"product:read"}
 *      },
 *      
 *      denormalizationContext={
 *         "disable_type_enforcement"=true,
 *         "groups"={"product:write"}
 *      },
 * 
 *       collectionOperations={
 *           "GET"={
 *               "normalization_context"={"groups"={"product:list"}}
 *            },
 *           "POST"={},
 *       },
 *       itemOperations={
 * 
 *           "GET"={},
 *           "PUT"={},
 *           "DELETE"={},
 *       },
 * )
 *
 * @ApiFilter(
 *      SearchFilter::class, 
 *      properties={
 *          "reference": "exact", 
 *          "name": "partial"})
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"product:list","product:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Ce champs ne peut être vide.")
     * @Assert\Length(min="5", max="15",
     *   minMessage="Ce champ doit contenir un minimum de {{ limit }} caractères.",
     *   maxMessage="Ce champ doit contenir un maximum de {{ limit }} caractères."
     * )
     * @Groups({"product:list","product:read","product:write"})
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs ne peut être vide.")
     * @Assert\Length(min="5", max="100",
     *   minMessage="Ce champ doit contenir un minimum de {{ limit }} caractères.",
     *   maxMessage="Ce champ doit contenir un maximum de {{ limit }} caractères.")
     * @Groups({"product:list","product:read","product:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Ce champs ne peut être vide.")
     * @Groups({"product:read","product:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Ce champs ne peut être vide.")
     * @Assert\Type(type="numeric", message="Le montant doit être de type numérique.")
     * @Assert\Range(min="500", max="1500",
     *   minMessage="Ce champ doit être supérieur ou égale à {{ limit }}.",
     *   maxMessage="Ce champ doit être inférieur ou égale à {{ limit }}."
     * )
     * @Groups({"product:list","product:read","product:write"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Ce champs ne peut être vide.")
     * @Assert\Type(type="numeric", message="Le montant doit être de type numérique.")
     * @Assert\Range(min="5", max="1000",
     *  minMessage="Ce champ doit être supérieur ou égale à {{ limit }}.",
     *  maxMessage="Ce champ doit être inférieur ou égale à {{ limit }}."
     * )
     * @Groups({"product:read","product:write"})
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
