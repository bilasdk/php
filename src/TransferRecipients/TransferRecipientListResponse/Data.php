<?php

declare(strict_types=1);

namespace Bila\TransferRecipients\TransferRecipientListResponse;

use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;
use Bila\PaginationMetaDto;
use Bila\TransferRecipients\RecipientResponseDto;

/**
 * @phpstan-import-type RecipientResponseDtoShape from \Bila\TransferRecipients\RecipientResponseDto
 * @phpstan-import-type PaginationMetaDtoShape from \Bila\PaginationMetaDto
 *
 * @phpstan-type DataShape = array{
 *   data: list<RecipientResponseDto|RecipientResponseDtoShape>,
 *   meta: PaginationMetaDto|PaginationMetaDtoShape,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * List of recipients.
     *
     * @var list<RecipientResponseDto> $data
     */
    #[Required(list: RecipientResponseDto::class)]
    public array $data;

    /**
     * Pagination metadata.
     */
    #[Required]
    public PaginationMetaDto $meta;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(data: ..., meta: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withData(...)->withMeta(...)
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
     * @param list<RecipientResponseDto|RecipientResponseDtoShape> $data
     * @param PaginationMetaDto|PaginationMetaDtoShape $meta
     */
    public static function with(
        array $data,
        PaginationMetaDto|array $meta
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['meta'] = $meta;

        return $self;
    }

    /**
     * List of recipients.
     *
     * @param list<RecipientResponseDto|RecipientResponseDtoShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Pagination metadata.
     *
     * @param PaginationMetaDto|PaginationMetaDtoShape $meta
     */
    public function withMeta(PaginationMetaDto|array $meta): self
    {
        $self = clone $this;
        $self['meta'] = $meta;

        return $self;
    }
}
