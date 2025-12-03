# 📦 ACF Blocks Library

Ce repository contient une collection de **blocs Gutenberg personnalisés** développés avec **ACF** (Advanced Custom Fields).  
L’objectif est de créer une base réutilisable de blocs modulaires, propres et faciles à intégrer dans n’importe quel thème WordPress.

Chaque bloc possède :
- un dossier dédié  
- un `block.json` conforme aux standards WordPress  
- un template PHP de rendu  
- des styles optionnels  
- une définition ACF (en JSON exporté automatiquement)

Cette librairie sert à la fois d’exemple, d’entraînement et de starter pour de futurs projets WordPress.

---

## 🗂️ Structure

```bash
/
├── blocks/
│   ├── video-fancybox/
│   │   ├── block.json
│   │   ├── video.php
│   │   ├── style.css
│   │   └── video.js
│   │
│   └── ... (autres blocs)
│
├── acf-json/
│
└── blocs.php
```


## 📚 Liste des blocs

### 🎬 Video Lightbox Block
Un bloc permettant d'afficher une vidéo dans une lightbox Fancybox, avec prise en charge d’une vidéo locale (MP4) ou d’un lien externe (YouTube, Vimeo…).

✨ Fonctionnalités
- Upload d’une vidéo MP4
- Ou ajout d’une URL vidéo (YouTube / Vimeo / autre)
- Miniature YouTube automatique (récupération de la vignette à partir de l’ID vidéo)
- Bouton Play avec couleur personnalisable
- Ouverture de la vidéo en Fancybox
