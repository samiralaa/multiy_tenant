<?php

namespace App\Repositories;
use App\Models\RequestPrice as EloquentRequestPrice;
use Domain\Entities\RequestPrice;


use Domain\Repositories\RequestPriceRepositoryInterface;

class RequestPriceRepository implements RequestPriceRepositoryInterface
{
    public function save(RequestPrice $requestPrice): RequestPrice
    {
        $eloquentRequestPrice = new EloquentRequestPrice([
            'name' => $requestPrice->getName(),
            'phone' => $requestPrice->getPhone(),
            'email' => $requestPrice->getEmail(),
            'service' => $requestPrice->getService(),
            'project_type' => $requestPrice->getProjectType(),
            'project_area' => $requestPrice->getProjectArea(),
            'project_address' => $requestPrice->getProjectAddress(),
            'client_requirements' => $requestPrice->getClientRequirements(),
        ]);

        $eloquentRequestPrice->save();

        $requestPrice->setId($eloquentRequestPrice->id);

        return $requestPrice;
    }

    public function findById(int $id): ?RequestPrice
    {
        $eloquentRequestPrice = EloquentRequestPrice::find($id);

        if (!$eloquentRequestPrice) {
            return null;
        }

        return new RequestPrice(
            $eloquentRequestPrice->name,
            $eloquentRequestPrice->phone,
            $eloquentRequestPrice->email,
            $eloquentRequestPrice->service,
            $eloquentRequestPrice->project_type,
            $eloquentRequestPrice->project_area,
            $eloquentRequestPrice->project_address,
            $eloquentRequestPrice->client_requirements
        );
    }

    public function update(RequestPrice $requestPrice): bool
    {
        $eloquentRequestPrice = EloquentRequestPrice::find($requestPrice->getId());

        if (!$eloquentRequestPrice) {
            return false;
        }

        $eloquentRequestPrice->name = $requestPrice->getName();
        $eloquentRequestPrice->phone = $requestPrice->getPhone();
        $eloquentRequestPrice->email = $requestPrice->getEmail();
        $eloquentRequestPrice->service = $requestPrice->getService();
        $eloquentRequestPrice->project_type = $requestPrice->getProjectType();
        $eloquentRequestPrice->project_area = $requestPrice->getProjectArea();
        $eloquentRequestPrice->project_address = $requestPrice->getProjectAddress();
        $eloquentRequestPrice->client_requirements = $requestPrice->getClientRequirements();

        return $eloquentRequestPrice->save();
    }

    public function delete(int $id): bool
    {
        $eloquentRequestPrice = EloquentRequestPrice::find($id);

        if (!$eloquentRequestPrice) {
            return false;
        }

        return $eloquentRequestPrice->delete();
    }
}