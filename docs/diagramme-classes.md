# Diagramme de classes — Perdu de vue

GitHub affiche ce diagramme Mermaid directement. Pour le rapport, on peut l'exporter en image depuis
<https://mermaid.live> (copier le bloc ci-dessous, puis *Actions → PNG*).

```mermaid
classDiagram
    direction LR

    class Place {
        +int id
        +string name
        +PlaceKind kind
        +datetime created_at
        +datetime updated_at
        +items() HasMany
    }

    class Item {
        +int id
        +int place_id
        +string name «max 60»
        +string? description
        +Color color
        +date found_on
        +date? returned_at
        +datetime created_at
        +datetime updated_at
        +place() BelongsTo
        +tags() BelongsToMany
        +isReturned() bool
    }

    class Tag {
        +int id
        +string name
        +datetime created_at
        +datetime updated_at
        +items() BelongsToMany
    }

    class PlaceKind {
        <<enumeration>>
        Hall = hall
        Platform = platform
        Train = train
        +label() string
        +badgeClasses() string
    }

    class Color {
        <<enumeration>>
        Black, White, Grey, Red
        Blue, Green, Yellow, Orange
        Brown, Pink, Purple, Multicolor
        +label() string
        +badgeClasses() string
        +swatchClasses() string
        +options()$ array
    }

    Place "1" *-- "0..*" Item : contient
    Item "0..*" -- "0..*" Tag : item_tag
    Place ..> PlaceKind : kind
    Item ..> Color : color
```

## Lecture

- **Place 1 — 0..\* Item**, une **composition** (losange plein) : un objet appartient à un seul lieu,
  et supprimer le lieu supprime ses objets (`cascadeOnDelete()` sur `place_id`).
- **Item 0..\* — 0..\* Tag** : plusieurs-à-plusieurs, par la table de liaison `item_tag`
  (clé primaire composée `item_id` + `tag_id`, cascade des deux côtés).
- Les enums sont stockés en texte dans la base et convertis par `casts()` dans les modèles.
