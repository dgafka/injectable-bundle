# Injectable-Bundle

#### Description

`Injectable-bundle` is responsible for injecting array of objects into your class.
By tagging you mark an service to be injected into your target service.

Example use [JMSDiExtraBundle](https://github.com/schmittjoh/JMSDiExtraBundle), but you can
easily configure it with `services.yml`

##### Target Service


    /**
    * @DI\Service("template_factory")
    */
    class TemplateFactory
    {
        /**
        * @param array|Template[] $providers
        */
        private $providers;
    
        /**
         * @DI\InjectParams({
         *      "providers" = @DI\Inject("%empty_array%")
         * })
         */
        public function __construct(array $providers)
        {
            $this->providers = $providers;
        }
        
        public function createFor(string $type) : Template
        {
            foreach ($this->providers as $provider) {
                if ($provider->isHandling($type)) {
                    return $provider;
                }
            }
            
            throw new \Exception("Template for {$type} doesn't exists!");
        }
    }
    
    interface Template
    {
        public function render() : string
        
        public function isHandling(string $type) : bool;
    }
    
    
#####   Injected Services
    
    /**
     * @DI\Service()
     * @DI\Tag(name="injectable", attributes={"to"="template_factory", "index"="0"})
     */
    class NiceTemplate implements Template
    {
        public function render()
       {
            return "nice template";
       }
       
       public function isHandling(string $type) : bool
       {
            return $type === 'nice';
       }
    }

    /**
     * @DI\Service()
     * @DI\Tag(name="injectable", attributes={"to"="template_factory", "index"="0"})
     */
    class UglyTemplate implements Template
    {
        public function render()
       {
            return "ugly template";
       }
       
      public function isHandling(string $type) : bool
      {
           return $type === 'ugly';
      }
    }
    
Above service will be injected into TemplateFactory.  
If there will be no services tagged as injectable for `template_factory`, template factory
will use of empty array.



### Understanding the annotations

    @DI\Tag(name="injectable", attributes={"to"="template_factory", "index"="0"})
    
* `name="injectable"` - Marks service `to be used` by InjectableBundle 
* `"to"="template_factory"` - Sets target service
* `"index"="0"` - Sets target service constructor argument index 