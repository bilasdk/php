<?php

declare(strict_types=1);

namespace Bila\TransferRecipients;

use Bila\Core\Attributes\Optional;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;
use Bila\TransferRecipients\TransferRecipientListParams\Type;

/**
 * Retrieve a paginated list of saved transfer recipients.
 *
 * @see Bila\Services\TransferRecipientsService::list()
 *
 * @phpstan-type TransferRecipientListParamsShape = array{
 *   page?: float|null, perPage?: float|null, type?: null|Type|value-of<Type>
 * }
 */
final class TransferRecipientListParams implements BaseModel
{
    /** @use SdkModel<TransferRecipientListParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * Filter by recipient type.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?float $page = null,
        ?float $perPage = null,
        Type|string|null $type = null
    ): self {
        $self = new self;

        null !== $page && $self['page'] = $page;
        null !== $perPage && $self['perPage'] = $perPage;
        null !== $type && $self['type'] = $type;

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
     * Filter by recipient type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
