# Cahier des charges - Projet Hihi

**Équipe :** Eva Avila Muñoz, Kevin Grêt

---

## Description

Le projet Hihi est né de la rencontre inopinée de deux ingénieurs des médias et d'une petite poupée laissée à l'abandon par une petite fille de 12 ans dans une boulangerie. Cette figurine, baptisée « HiHi », réveilla en nous ce sentiment candide d'avoir un petit compagnon nous accompagnant là où nous allons. À partir de là, la cosmogonie de HiHi vit sa genèse arriver, et nous étions prêts à la développer dans un projet web complètement déjanté.

---

## Fonctionnalités principales

Le projet web a pour but de découvrir la « HiHi » qui sommeille en nous, grâce à un test de personnalité unique. Une fois ce test terminé, l'utilisateur se verra attribuer l'une des quatre « HiHi » existantes dans la mythologie de notre poupée favorite.

Fortement inspiré, dans son concept, du site internet de [Harry Potter - Sorting Hat](https://www.harrypotter.com/sorting-hat), permettant de savoir à quelle maison de sorcier on appartient, notre projet se différenciera par le contenu du test et les différentes significations des quatre issues possibles.

### Comptes
- Création d'un compte, connexion et déconnexion.
- Modification de son profil (nom, prénom, e-mail, mot de passe, langue).
- Deux rôles : utilisateur et administrateur (le rôle administrateur est attribué par l'administration).

### Section "Ma HiHi"
- Enregistre la poupée reçue après la complétion du questionnaire (son type, son nom, ses spécificités).

### Le Test de personnalité (Le Choixpeau version HiHi)
- Questionnaire interactif et immersif (présentation dynamique des questions avec ambiance visuelle).
- Algorithme de calcul pondéré basé sur les choix pour déterminer l'affinité avec l'une des quatre « HiHi ».
- Gestion automatique des ex-aequo (via une logique de pondération ou une question subsidiaire).

### Résultat et profil « HiHi »
- Séquence de révélation animée et théâtrale de la « HiHi » attribuée.
- Fiche descriptive détaillée de la « HiHi » (mythologie de la poupée, traits de caractère, forces, symbolique).
- Sauvegarde du résultat dans l'espace personnel pour pouvoir le consulter à tout moment.

### Partage et communauté
- Génération d'une carte de profil personnalisée de la « HiHi » obtenue.
- Fonctionnalité de partage du résultat sur les réseaux sociaux.

### Administration
- Gestion des questions, des choix et de la logique de pondération du test de personnalité.
- Gestion du contenu et des descriptions des quatre « HiHi » de la mythologie.
- Gestion des comptes utilisateurs et des rôles.

### Autres aspects techniques
- **Multilingue :** interface disponible en français (et adaptable en anglais).
- **E-mails :** envoi d'un récapitulatif personnalisé de la « HiHi » attribuée après le test ou à la demande.

---

## Structure globale du site (Schéma)

```text
Page d'accueil
  └── Test de personnalité
        ├── HiHi 1
        ├── HiHi 2
        ├── HiHi 3
        └── HiHi 4
```

---

## Fonctionnalités optionnelles

Si le temps nous le permet, nous aimerions l'investir dans le test de personnalité, car c'est là qu'il y aura la possibilité de déchaîner notre créativité. En plus des questions à choix multiples de base, on pourrait y ajouter des phases de jeux de rôle, avec une narration plus poussée. 

Dans le cas où nous serions déjà satisfaits de notre test, nous ajouterions la possibilité de modifier certains aspects de l'apparence de la « HiHi », comme son sac à main ou ses habits.