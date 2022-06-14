<?php


namespace App\API\Serializers;


use League\Fractal\Serializer\ArraySerializer;

class CustomArraySerializer extends ArraySerializer
{

    /**
     * @param string|null $resourceKey
     * @param array $data
     * @return array
     */
    
    public function collection(?string $resourceKey, array $data): array
    {
        return $data;
    }

}
