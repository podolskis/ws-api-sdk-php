<?php

namespace Isign;

abstract class DocumentTypeProvider
{
    const PDF = 'pdf';

    const ADOC = 'adoc';
    const ADOC_BEDOC = 'adoc.bedoc';
    const ADOC_CEDOC = 'adoc.cedoc';
    const ADOC_GEDOC = 'adoc.gedoc';
    const ADOC_GGEDOC = 'adoc.ggedoc';

    const MDOC = 'mdoc';
    const MDOC_BEDOC = 'mdoc.bedoc';
    const MDOC_CEDOC = 'mdoc.cedoc';
    const MDOC_GEDOC = 'mdoc.gedoc';
    const MDOC_GGEDOC = 'mdoc.ggedoc';

    final public static function getAllDocumentTypes()
    {
        return [
            self::PDF,
            self::ADOC,
            self::ADOC_BEDOC,
            self::ADOC_CEDOC,
            self::ADOC_GEDOC,
            self::ADOC_GGEDOC,
            self::MDOC,
            self::MDOC_BEDOC,
            self::MDOC_CEDOC,
            self::MDOC_GEDOC,
            self::MDOC_GGEDOC
        ];
    }

    final public static function getPrimaryDocumentTypes()
    {
        return [
            self::PDF,
            self::ADOC,
            self::MDOC,
        ];
    }
}
