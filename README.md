# Medical Database & API

## Description

This project contains all scripts to fetch and store data as well as a fully functioning API to fetch this data.

Live API is available at https://data.instamed.fr

5 type of data are currently available :

### RPPS Data
- The RPPS (Répertoire Partagé des Professionnels de Santé) contains all the data of French health professionals 

### Drugs data
- The drugs data contains all the data of allowed drugs on the French Market

### Diseases data
- The diseases data contains all the data from the OMS CIM-10 database

### Allergens data
- The allergens data contains all the alergens that are known

### CCAM data
- The CCAM data contains all the medical acts and their reimbursment rate by the social security


## Installation

### Docker Setup

**Prerequisites:**

- Have docker installed
- Have docker-compose installed

**Full Setup:**

Duration: ~90 minutes

```
$ make install
```

**Setup without data imports:**

Duration: ~15/20 minutes

```
$ make install-app
```

### Local Setup

TODO