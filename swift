heat_template_version: 2014-10-16

resources:
  swift:
     type: OS::Swift::Container
     properties:
       X-Container-Read: .r:*
       X-Container-Write: project7:*

outputs:
  swiftURL:
     value: { get_attr: [ swift, WebsiteURL ] }
  swiftDomain:
     value: { get_attr: [ swift, DomainName ] }
   
