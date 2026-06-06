<?php

declare(strict_types=1);

namespace Bila;

use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-type PaginationMetaDtoShape = array{
 *   currentPage: float, pageCount: float, perPage: float, total: float
 * }
 */
final class PaginationMetaDto implements BaseModel
{
    /** @use SdkModel<PaginationMetaDtoShape> */
    use SdkModel;

    /**
     * Current page number.
     */
    #[Required]
    public float $currentPage;

    /**
     * Total number of pages.
     */
    #[Required]
    public float $pageCount;

    /**
     * Items per page.
     */
    #[Required]
    public float $perPage;

    /**
     * Total number of records.
     */
    #[Required]
    public float $total;

    /**
     * `new PaginationMetaDto()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaginationMetaDto::with(
     *   currentPage: ..., pageCount: ..., perPage: ..., total: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaginationMetaDto)
     *   ->withCurrentPage(...)
     *   ->withPageCount(...)
     *   ->withPerPage(...)
     *   ->withTotal(...)
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
     */
    public static function with(
        float $currentPage,
        float $pageCount,
        float $perPage,
        float $total
    ): self {
        $self = new self;

        $self['currentPage'] = $currentPage;
        $self['pageCount'] = $pageCount;
        $self['perPage'] = $perPage;
        $self['total'] = $total;

        return $self;
    }

    /**
     * Current page number.
     */
    public function withCurrentPage(float $currentPage): self
    {
        $self = clone $this;
        $self['currentPage'] = $currentPage;

        return $self;
    }

    /**
     * Total number of pages.
     */
    public function withPageCount(float $pageCount): self
    {
        $self = clone $this;
        $self['pageCount'] = $pageCount;

        return $self;
    }

    /**
     * Items per page.
     */
    public function withPerPage(float $perPage): self
    {
        $self = clone $this;
        $self['perPage'] = $perPage;

        return $self;
    }

    /**
     * Total number of records.
     */
    public function withTotal(float $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }
}
