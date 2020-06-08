# WEBTE2 - Skúškové zadanie (back-end časť) 💻

## Zadanie

Back-end časť zadania má za úlohu sprostredkovať potrebné dáta z Octave pre klientskú časť pomocou REST API. 

## Povinné požiadavky

1. Vypracovať rozhranie nad Octave
2. Vytvoriť REST API zabezpečenú API kľúčom
3. Logovať všetky prístupy do Octave API

## Potrebná inštalácia

```
sudo apt-get install octave
sudo apt-get install liboctave-dev
pkg install -global -forge control
```


## Octave API referencia

### Pošli Octave príkaz

**POST**

https://wt43.fei.stuba.sk:4443/api/console?api-key={apiKey}

| URI parameter |                                        |
|---------------|----------------------------------------|
| apiKey        | Tajný autentifikačný token používateľa |

| Body parametre |                                        |
|----------------|----------------------------------------|
| session        | Session ID používateľa                 |
| command        | Octave príkaz                          |


#### Telo odpovede

```json
{
    "content": [
        "1 3",
        "2 2",
        "3 1"
    ],
    "returnCode": 0
}
```

### Získaj dáta prevráteného kyvadla

**GET**

https://wt43.fei.stuba.sk:4443/api/experiments/pendulum?session={sessionID}&r={r}&api-key={apiKey}

| URI parametre |                                        |
|---------------|----------------------------------------|
| sessionID     | Session ID používateľa                 |
| r             | Číselná hodnota vstupu používateľa     |
| apiKey        | Tajný autentifikačný token používateľa |

#### Telo odpovede

```json
{
    "data": [
        {
            "x": 10,
            "y": 5.99864,
            "angle": 0
        }
    ],
    "returnCode": 0,
    "rangeFrom": 0,
    "rangeTo": 6
}
```

### Získaj dáta guličky na tyči

**GET**

https://wt43.fei.stuba.sk:4443/api/experiments/ball?session={sessionID}&r={r}&api-key={apiKey}

| URI parametre |                                        |
|---------------|----------------------------------------|
| sessionID     | Session ID používateľa                 |
| r             | Číselná hodnota vstupu používateľa     |
| apiKey        | Tajný autentifikačný token používateľa |

#### Telo odpovede

```json
{
    "data": [
        {
            "x": 5,
            "y": 90.00615,
            "angle": 0
        }
    ],
    "returnCode": 0,
    "rangeFrom": 0,
    "rangeTo": 90
}
```

### Získaj dáta tlmiča kolesa

**GET**

https://wt43.fei.stuba.sk:4443/api/experiments/suspension?session={sessionID}&r={r}&api-key={apiKey}

| URI parametre |                                        |
|---------------|----------------------------------------|
| sessionID     | Session ID používateľa                 |
| r             | Číselná hodnota vstupu používateľa     |
| apiKey        | Tajný autentifikačný token používateľa |

#### Telo odpovede

```json
{
    "content": [
        {
            "x": 5,
            "y": 6.00041,
            "bodyworkHeight": 0.00041
        }
    ],
    "returnCode": 0,
    "rangeFrom": 0,
    "rangeTo": 6
}
```

### Získaj dáta náklonu lietadla

**GET**

https://wt43.fei.stuba.sk:4443/api/experiments/aircraft?session={sessionID}&r={r}&api-key={apiKey}

| URI parametre |                                        |
|---------------|----------------------------------------|
| sessionID     | Session ID používateľa                 |
| r             | Číselná hodnota vstupu používateľa     |
| apiKey        | Tajný autentifikačný token používateľa |

#### Telo odpovede

```json
{
    "data": [
        {
            "x": 40,
            "y": 0.29979,
            "rearFlapAngle": 0.00101
        }
    ],
    "returnCode": 0,
    "rangeFrom": 0,
    "rangeTo": 0.3
}
```

### Získaj všetky zalogované súbory

**GET**

https://wt43.fei.stuba.sk:4443/api/logs?api-key={apiKey}

| URI parametre |                                        |
|---------------|----------------------------------------|
| apiKey        | Tajný autentifikačný token používateľa |

#### Telo odpovede

```json
[
    {
        "timestamp": "2020-01-01 10:10:10",
        "command": "console",
        "session": "j057t7hrv9d71p1vt1b010e080",
        "status": "success",
        "info": "Operation was successfull"
    }
]
```

### Získaj posledný vstup a hodnoty experimentu

**GET**

https://wt43.fei.stuba.sk:4443/api/logs?experiment={experiment}&session={sessionID}&api-key={apiKey}

| URI parametre |                                        |
|---------------|----------------------------------------|
| experiment    | Názov experimentu                      |
| sessionID     | Session ID používateľa                 |
| apiKey        | Tajný autentifikačný token používateľa |

#### Telo odpovede

```json
{
    "r": 0,
    "lastPosition": {
        "x": 5,
        "y": 4.90037,
        "bodyworkHeight": 0.00037
    }
}
```

### Získaj štatistiky

**GET**

https://wt43.fei.stuba.sk:4443/api/stats?api-key={apiKey}

| URI parametre |                                        |
|---------------|----------------------------------------|
| apiKey        | Tajný autentifikačný token používateľa |

#### Telo odpovede

```json
[
    {
        "experiment": "Inverted Pendulum",
        "count": 1
    },
    {
        "experiment": "Ball & Beam",
        "count": 1
    },
    {
        "experiment": "Car Suspension",
        "count": 1
    },
    {
        "experiment": "Aircraft Pitch",
        "count": 1
    }
]
```

    

## Autori

- [Ján Korček](https://github.com/korcekj)
- [Stanislav Pekarovič](https://github.com/stanley255)
- [Matej Friedel](https://github.com/MatejFriedel)
- [Martin Knoško](https://github.com/mknosko)
