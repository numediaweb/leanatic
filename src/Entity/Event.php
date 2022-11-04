<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"
 *
 *     },
 *     itemOperations={
 *         "get",
 *     }
 * )
 */
class Event extends AbstractEntity
{
    /**
     * TYPE_VISITOR = 1;
     * TYPE_REGISTRATION = 2;
     * TYPE_LEANATIC = 3;
     * TYPE_PIMCORE = 4;
     * .
     */
    public const EVENT_TYPES = [1, 2, 3, 4];

    /**
     * Event type.
     *
     * Values are: 1 => visitors, 2 => registrations, 3 => leanatic, 4 => pimcore
     *
     * @var int
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @Assert\Choice(choices=Event::EVENT_TYPES, message="Choose a valid event type.")
     */
    private $type;

    /**
     * Could also be a user object in Json, for example, to also display other data
     * such as name, surname, etc.
     *
     * @ORM\Column(type="json")
     * @ApiProperty(
     *     openapiContext={
     *         "type": "object",
     *         "example": "{""userName"":  ""Almo"", ""browser"":  ""Chrome""}",
     *     }
     * )
     */
    private $data;

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }
}
