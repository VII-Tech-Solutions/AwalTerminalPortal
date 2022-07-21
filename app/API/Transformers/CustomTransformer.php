<?php

namespace App\API\Transformers;

use App\Constants\Values;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

/**
 * Class CustomTransformer
 * @package App\API\Transformers
 */
class CustomTransformer extends TransformerAbstract
{
    public $fields;
    public $extra_fields;

    /**
     * CustomTransformer constructor.
     * @param null $fields
     */
    public function __construct($fields = null)
    {
        if (!is_null($fields)) {
            $this->fields = $fields;
        }
    }

    /**
     * Transform
     * @param $item
     * @return array
     */
    public function transform($item)
    {
        if (is_null($item)) {
            $item = collect();
        }
        if (!is_null($this->extra_fields)) {
            foreach ($this->extra_fields as $key => $value) {
                $item[$key] = $item->{$value};
            }
        }
        return collect($item->toArray())->only($this->fields)->toArray();
    }

    /**
     * Include Tags
     * @param $item
     * @return Collection
     */
    public function includeTags($item)
    {
        if (is_a($item, TripItem::class)) {
            $tags = $item->tags();
        } else {
            $tags = $item->tags;
        }
        return $this->collection($tags, new IDTransformer(), Values::NO_RESOURCE_KEY);
    }

    /**
     * Include Amenities
     * @param $item
     * @return Collection
     */
    public function includeAmenities($item)
    {
        return $this->collection($item->amenities, new IDTransformer(), Values::NO_RESOURCE_KEY);
    }

    /**
     * Include Types
     * @param $item
     * @return Collection
     */
    public function includeTypes($item)
    {
        return $this->collection($item->types, new IDTransformer(), Values::NO_RESOURCE_KEY);
    }

    /**
     * Include Addons
     * @param $item
     * @return Collection
     */
    public function includeAddons($item)
    {
        return $this->collection($item->addons, new IDTransformer(), Values::NO_RESOURCE_KEY);
    }

    /**
     * Include Tickets
     * @param $item
     * @return Collection
     */
    public function includeTickets($item)
    {
        return $this->collection($item->tickets, new IDTransformer(), Values::NO_RESOURCE_KEY);
    }

    /**
     * Include Types
     * @param $item
     * @return Collection
     */
    public function includeTripItems($item)
    {
        return $this->collection($item->items, new IDTransformer(), Values::NO_RESOURCE_KEY);
    }

    /**
     * Include Media
     * @param $item
     * @return Collection
     */
    public function includeMedia($item)
    {
        return $this->collection($item->media, new IDTransformer(), Values::NO_RESOURCE_KEY);
    }

    /**
     * Include Bullet Points
     * @param $item
     * @return Collection
     */
    public function includeBulletPoints($item) {
        return $this->collection($item->bulletPointsContent, new ListBulletPointsContentTransformer(), Values::NO_RESOURCE_KEY);
    }

    /**
     * Include Image Gallery
     * @param $item
     * @return Collection
     */
    public function includeImageGallery($item) {
        return $this->collection($item->imageGalleryContent, new ListImageGalleryContentTransformer(), Values::NO_RESOURCE_KEY);
    }

    /**
     * Include Our Photo Gallery
     * @param $item
     * @return Collection
     */
    public function includeOurPhotoGallery($item) {
        return $this->collection($item->OurPhotoGallery, new ListImageGalleryContentTransformer(), Values::NO_RESOURCE_KEY);
    }

    /**
     * Include Our Photo Gallery
     * @param $item
     * @return Collection
     */
    public function includePrivateAndPersonalGallery($item) {
        return $this->collection($item->PrivateAndPersonalGallery, new ListImageGalleryContentTransformer(), Values::NO_RESOURCE_KEY);
    }
}
