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
    }
    
    interface Template
    {
        public function render() : string
    }
    
    
Injected Services
    
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
    }
    
Above service will be injected into TemplateFactory.  
If there will be no services tagged as injectable for `template_factory`, template factory
will use of empty array.



### Understanding the annotations

    @DI\Tag(name="injectable", attributes={"to"="template_factory", "index"="0"})
    
* `name="injectable"` - Marks service `to be used` of InjectableBundle 
* `"to"="template_factory"` - Sets target service
* `"index"="0"` - Sets target service argument index 