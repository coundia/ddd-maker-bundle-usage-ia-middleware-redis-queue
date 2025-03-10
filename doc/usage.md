# Install 

```
composer require cnd/ddd-maker-bundle --dev
```
Or update if exists
```
composer update cnd/ddd-maker-bundle --dev
```
##  1. Create an entity with constructor and Getters Setters (or public)


```php
<<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'wallets')]
class Wallet{
	#[ORM\Column(type: 'datetime_immutable')]
	private \DateTimeImmutable $createdAt;
	#[ORM\Id]
	#[ORM\Column(type: 'string', unique: true)]
	private string $id;

	public function __construct(

		#[ORM\Column(type: 'string', length: 20, unique: true)]
		public string $phoneNumber,

		#[ORM\Column(type: 'decimal', precision: 15, scale: 2)]
		public float $balance,

		#[ORM\Column(type: 'string', length: 50)]
		public string $provider,

	){
		$this->createdAt = new \DateTimeImmutable();
	}

	public function getCreatedAt(): \DateTimeImmutable{
		return $this->createdAt;
	}

	public function getId(): string{
		return $this->id;
	}
	
}
```


```
php bin/console make:entity  
```

# 2. Generate full files ddd struct

## Create all files with overwrite
```
php bin/console make:ddd-full Wallet 
```
or

```
php bin/console make:ddd-full Wallet --force true
``` 
1. created: src/Shared/Domain/DTO/ApiResponseDTO.php
2. created: src/Shared/Domain/DTO/ErrorResponseDTO.php
3. created: src/Shared/Domain/DTO/ValidationErrorResponseDTO.php
4. created: src/Shared/Domain/Response/Response.php
5. created: src/Shared/Domain/Response/ResponseAssert.php
6. created: src/Shared/Domain/Response/ResponseType.php
7. created: src/Shared/Domain/Aggregate/AggregateRoot.php
8. created: tests/Shared/Assertions/ResponseAssertions.php
9. created: tests/Shared/BaseWebTestCase.php
10. created: src/Shared/Domain/Event/DomainEventInterface.php
11. created: src/Shared/Domain/ValueObject/ValueObject.php
12. created: src/Shared/Application/EventListener/EventListener.php
13. created: src/Shared/Application/EventDispatcher/EventDispatcher.php
14. created: src/Shared/Application/Bus/CommandBus.php
15. created: src/Shared/Application/Bus/CommandHandler.php
16. created: src/Shared/Application/Bus/MessageAsync.php
17. created: src/Shared/Application/Bus/MessageBus.php
18. created: src/Shared/Application/Bus/MessageHandler.php
19. created: src/Shared/Application/Bus/QueryBus.php
20. created: src/Shared/Application/Bus/QueryHandler.php
21. created: src/Shared/Application/Mail/Mailer.php
22. created: src/Shared/Application/EventListener/ExceptionListener.php
23. created: src/Shared/Infrastructure/EventListener/ExceptionListener.php
24. created: src/Shared/Infrastructure/EventDispatcher/EventDispatcher.php
25. created: src/Shared/Infrastructure/Bus/CommandBus.php
26. created: src/Shared/Infrastructure/Bus/CommandHandler.php
27. created: src/Shared/Infrastructure/Bus/MessageAsync.php
28. created: src/Shared/Infrastructure/Bus/MessageAsyncBus.php
29. created: src/Shared/Infrastructure/Bus/MessageHandler.php
30. created: src/Shared/Infrastructure/Bus/QueryBus.php
31. created: src/Shared/Infrastructure/Bus/QueryHandler.php
32. created: src/Shared/Infrastructure/Mail/Mailer.php
33. created: src/Shared/Infrastructure/EventListener/EventListener.php
34. created: src/Shared/Presentation/Controller/BaseController.php
35. created: src/Core/Application/DTO/WalletRequestDTO.php
36. created: src/Core/Application/DTO/WalletDTO.php
37. created: src/Core/Application/DTO/WalletResponseDTO.php
38. created: src/Core/Infrastructure/Factory/WalletFactory.php
39. created: src/Core/Infrastructure/Story/WalletStory.php
40. created: src/Core/Infrastructure/DataFixtures/WalletFixtures.php
41. created: src/Core/Infrastructure/Voters/WalletVoter.php
42. created: src/Core/Domain/ValueObject/WalletPhoneNumber.php
43. created: src/Core/Domain/ValueObject/WalletBalance.php
44. created: src/Core/Domain/ValueObject/WalletProvider.php
45. created: src/Core/Domain/ValueObject/WalletId.php
46. created: src/Core/Domain/Aggregate/WalletModel.php
47. created: src/Core/Domain/Event/WalletEventCreated.php
48. created: src/Core/Domain/Event/WalletEventUpdated.php
49. created: src/Core/Domain/Event/WalletEventDeleted.php
50. created: src/Core/Domain/Exception/WalletException.php
51. created: src/Core/Domain/Repository/WalletRepositoryInterface.php
52. created: src/Core/Infrastructure/Persistence/WalletRepository.php
53. created: src/Core/Domain/UseCase/WalletCreateInterface.php
54. created: src/Core/Domain/UseCase/WalletDeleteInterface.php
55. created: src/Core/Domain/UseCase/WalletFindInterface.php
56. created: src/Core/Domain/UseCase/WalletUpdateInterface.php
57. created: src/Core/Application/Mapper/Wallet/WalletMapperInterface.php
58. created: src/Core/Application/Mapper/Wallet/WalletMapper.php
59. created: src/Core/Application/Command/CreateWalletCommand.php
60. created: src/Core/Application/CommandHandler/CreateWalletCommandHandler.php
61. created: src/Core/Presentation/Controller/CreateWalletController.php
62. created: tests/Functional/Wallet/CreateWalletCommandControllerTest.php
63. created: src/Core/Application/Query/FindByIdWalletQuery.php
64. created: src/Core/Application/QueryHandler/FindByIdWalletQueryHandler.php
65. created: src/Core/Presentation/Controller/FindByIdWalletController.php
66. created: tests/Functional/Wallet/FindByIdWalletQueryControllerTest.php

## Create files (not overwrite)
```
php bin/console make:ddd-full Wallet --force false
``` 
## Create files for Command 
```
php bin/console make:ddd-command Wallet UpdatePhone 
``` 
1. created: src/Core/Application/Command/UpdatePhoneWalletCommand.php
2. created: src/Core/Application/CommandHandler/UpdatePhoneWalletCommandHandler.php
3. created: src/Core/Presentation/Controller/UpdatePhoneWalletController.php
4. created: tests/Functional/Wallet/UpdatePhoneWalletCommandControllerTest.php

- Custom it
## Create files for Query
```
php bin/console make:ddd-query Wallet find phoneNumber
``` 
1. created: src/Core/Application/Query/FindByPhoneNumberWalletQuery.php
2. created: src/Core/Application/QueryHandler/FindByPhoneNumberWalletQueryHandler.php
3. created: src/Core/Presentation/Controller/FindByPhoneNumberWalletController.php
4. created: tests/Functional/Wallet/FindByPhoneNumberWalletQueryControllerTest.php


# Api doc

http://127.0.0.1:8000/api/docs

### Run tests

```
php bin/phpunit
```


- Custom it
## remark (Requis)
1. Only field in constructor is checked , 
2. Add all setters and getters
