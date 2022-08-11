<?php

    namespace Tests\Unit\Wrappers;

    use App\Models\Acl\ExtractIds;

    class ExtractIdsWrapper
    {
        use ExtractIds;

        public function getIds($input)
        {
            return $this->extractIdsFrom($input);
        }
    }
