<?php

declare(strict_types=1);

namespace Bila\Banks;

use Bila\Banks\BankListResponse\Data;
use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type DataShape from \Bila\Banks\BankListResponse\Data
 *
 * @phpstan-type BankListResponseShape = array{
 *   message: string, status: bool, data?: list<Data|DataShape>|null
 * }
 */
final class BankListResponse implements BaseModel
{
    /** @use SdkModel<BankListResponseShape> */
    use SdkModel;

    /**
     * Response message.
     */
    #[Required]
    public string $message;

    /**
     * Request success status.
     */
    #[Required]
    public bool $status;

    /** @var list<Data>|null $data */
    #[Optional(list: Data::class)]
    public ?array $data;

    /**
     * `new BankListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BankListResponse::with(message: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BankListResponse)->withMessage(...)->withStatus(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Data|DataShape>|null $data
     */
    public static function with(
        string $message,
        bool $status,
        ?array $data = null
    ): self {
        $self = new self;

        $self['message'] = $message;
        $self['status'] = $status;

        null !== $data && $self['data'] = $data;

        return $self;
    }

    /**
     * Response message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Request success status.
     */
    public function withStatus(bool $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * @param list<Data|DataShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
