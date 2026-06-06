<?php

declare(strict_types=1);

namespace Bila\Collections;

use Bila\Collections\CollectionListParams\Status;
use Bila\Core\Attributes\Optional;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;

/**
 * Retrieve a paginated list of payment collections for the authenticated merchant.
 *
 * @see Bila\Services\CollectionsService::list()
 *
 * @phpstan-type CollectionListParamsShape = array{
 *   accountID?: string|null,
 *   endDate?: string|null,
 *   page?: float|null,
 *   perPage?: float|null,
 *   startDate?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class CollectionListParams implements BaseModel
{
    /** @use SdkModel<CollectionListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by account ID.
     */
    #[Optional]
    public ?string $accountID;

    /**
     * Filter by end date (ISO 8601).
     */
    #[Optional]
    public ?string $endDate;

    /**
     * Page number (default: 1).
     */
    #[Optional]
    public ?float $page;

    /**
     * Items per page (default: 50).
     */
    #[Optional]
    public ?float $perPage;

    /**
     * Filter by start date (ISO 8601).
     */
    #[Optional]
    public ?string $startDate;

    /**
     * Filter by collection status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $accountID = null,
        ?string $endDate = null,
        ?float $page = null,
        ?float $perPage = null,
        ?string $startDate = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $endDate && $self['endDate'] = $endDate;
        null !== $page && $self['page'] = $page;
        null !== $perPage && $self['perPage'] = $perPage;
        null !== $startDate && $self['startDate'] = $startDate;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Filter by account ID.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Filter by end date (ISO 8601).
     */
    public function withEndDate(string $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * Page number (default: 1).
     */
    public function withPage(float $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * Items per page (default: 50).
     */
    public function withPerPage(float $perPage): self
    {
        $self = clone $this;
        $self['perPage'] = $perPage;

        return $self;
    }

    /**
     * Filter by start date (ISO 8601).
     */
    public function withStartDate(string $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * Filter by collection status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
