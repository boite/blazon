<?php

namespace Blazon\Handler;

use Blazon\Blazon;
use Blazon\Model\Site;
use Blazon\Model\Page;
use Parsedown;
use VKBansal\FrontMatter\Parser as FrontMatterParser;
use VKBansal\FrontMatter\Document as FrontMatterDocument;

class HtmlHandler
{
    protected $blazon;
    protected $content;
    
    public function __construct(Blazon $blazon)
    {
        $this->blazon = $blazon;
    }
    
    public function init(Page $page, $config)
    {
    }
    
    public function generate(Page $page)
    {
        $html = file_get_contents($this->blazon->getSrc() . '/' . $page->getSrc());
        
        $template = $this->blazon->getTwig()->loadTemplate('templates/default.html.twig');
        $site = $this->blazon->getSite();
        
        $data = [
            'content' => $html,
            'site' => $site,
            'page' => $page
        ];
        
        $output = $template->render($data);
        
        file_put_contents($this->blazon->getDest() . '/' . $page->getName() . '.html', $output);
    }
}
