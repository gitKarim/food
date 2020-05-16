<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @ORM\Entity(repositoryClass=UserRepository::class)
*/

class User extends AbstractController
{
/**
* @ORM\Column(type="integer" )
 * @ORM\GeneratedValue()
 * @ORM\Id()
*/
    private int $id;
    /**
    * @ORM\Column(type="string" ,length=255)
    */
    private string $firstname;
    /**
     * @ORM\Column(type="string" ,length=255)
     */
    private string $lastname;
    /**
     * @ORM\Column(type="string" ,length=255)
     */
    private string $email;
    /**
     * @ORM\Column(type="string" ,length=255)
     */
    private string $password;
    /**
     * @ORM\Column(type="string" ,length=255)
     */
    private string $avatar;

    /**
     * @ORM\OneToMany(targetEntity=Recipe::class, mappedBy="user", orphanRemoval=true)
     */
    private $recipes;

    /**
     * @ORM\OneToMany(targetEntity=Formation::class, mappedBy="user", orphanRemoval=true)
     */
    private $formations;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
        $this->formations = new ArrayCollection();
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->setUser($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
            // set the owning side to null (unless already changed)
            if ($recipe->getUser() === $this) {
                $recipe->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->setUser($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->contains($formation)) {
            $this->formations->removeElement($formation);
            // set the owning side to null (unless already changed)
            if ($formation->getUser() === $this) {
                $formation->setUser(null);
            }
        }

        return $this;
    }


}