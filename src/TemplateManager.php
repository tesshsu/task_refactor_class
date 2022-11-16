<?php

class TemplateManager
{

    /**
     * @var ApplicationContext
     */
    private $applicationContext;

    /**
     * TemplateManager constructor.
     */
    public function __construct()
    {
        $this->applicationContext = ApplicationContext::getInstance();
    }

    /**
     * @param Template $tpl
     * @param array $data
     * @return Template
     */
    public function getTemplateComputed(Template $tpl, array $data): Template
    {
        if (!$tpl) {
            throw new \RuntimeException('no tpl given');
        }

        $subject = $tpl->getSubject();
        $content = $tpl->getContent();

        $quote = (isset($data['quote']) and $data['quote'] instanceof Quote) ? $data['quote'] : null;

        if($quote) {
            $site = (!empty($quote->getSiteId()) && !is_null($quote->getSiteId())) ? SiteRepository::getInstance()->getById($quote->getSiteId()) : $this->applicationContext->getCurrentSite() ;
            $destination = (!empty($quote->getSiteId()) && !is_null($quote->getSiteId())) ? DestinationRepository::getInstance()->getById($quote->getDestinationId()) : null;
            $subject = $this->computeQuoteData($subject, $quote, $destination, $site);
            $content = $this->computeQuoteData($content, $quote, $destination, $site);
        }

        $user  = (isset($data['user'])  and ($data['user']  instanceof User)) ? $data['user'] : $this->applicationContext->getCurrentUser();

        if($user) {
            $subject = $this->computeUserData($subject, $user);
            $content = $this->computeUserData($content, $user);
        }

        $tpl->setSubject($subject);
        $tpl->setContent($content);

        return $tpl;
    }

    /**
     * @param $text
     * @param Quote $quote
     * @param $destination
     * @param $site
     * @return string|string[]|null
     */
    private function computeQuoteData($text, Quote $quote, $destination, $site)
    {
        if (!empty($quote)) {
            /** @var Destination $destination **/
            if (isset($destination)) {
                (strpos($text, '[quote:destination_name]') !== false) and $text = str_replace('[quote:destination_name]',$destination->getCountryName(),$text);
                /** @var Site $site **/
                $text = str_replace('[quote:destination_link]', $site->getUrl() . '/' . $destination->getCountryName() . '/quote/' . $quote->getId(), $text);
            }

            $containsSummaryHtml = strpos($text, '[quote:summary_html]');
            if ($containsSummaryHtml !== false) {
                $text = str_replace(
                    '[quote:summary_html]',
                    Quote::renderHtml($quote),
                    $text
                );
            }

            $containsSummary     = strpos($text, '[quote:summary]');
            if ($containsSummary !== false) {
                $text = str_replace(
                    '[quote:summary]',
                    Quote::renderText($quote),
                    $text
                );
            }
        }
        return preg_replace('/\[quote:(.)+\]/', '', $text);
    }

    /**
     * @param $text
     * @param User $user
     * @return string|string[]|null
     */
    private function computeUserData($text, User $user)
    {
        if (!empty($user)) {
            $dataUser = $user->toArray();
            foreach($dataUser as $key => $value){
                if($key == 'first_name') {
                    $value = ucfirst(mb_strtolower($value));
                }
                $needle = '[user:'.$key.']';
                $text = strpos($text, $needle) ? str_replace($needle,$value,$text) : str_replace($needle, '', $text);
            }
        }

        return preg_replace('/\[user:(.)+\]/', '', $text);
    }

}