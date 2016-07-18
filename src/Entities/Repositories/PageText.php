<?php

namespace Sztukmistrz\Pagina\Entities\Repositories;

use Doctrine\ORM\EntityRepository;
use LaravelLocalization;

/**
 * PageText
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PageText extends EntityRepository
{

    public function getHelpTexts($routeName)
    {
        $queryString = '

			SELECT   r

			FROM ' . $this->_entityName . ' r
			LEFT JOIN r.routeName rn
			LEFT JOIN r.pageTextType type
			WHERE rn.name = :routeName
			and type.name = :typeName
		';

        $this->query = $this->_em->createQuery($queryString);
        $this->query->setParameter('routeName', $routeName);
        $this->query->setParameter('typeName', 'help');

        $this->query->setHint(\Gedmo\Translatable\TranslatableListener::HINT_TRANSLATABLE_LOCALE, LaravelLocalization::getCurrentLocale());
        $this->query->setHint(
            \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );
        $record = $this->query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $record;

    }
}
