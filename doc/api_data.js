define({ "api": [
  {
    "type": "POST",
    "url": "/ping",
    "title": "",
    "name": "ping",
    "group": "API",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "etat",
            "description": "<p>L'état de l'API</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/ping.php",
    "groupTitle": "API"
  },
  {
    "type": "DELETE",
    "url": "/channels/:id",
    "title": "Effacer la conversation",
    "name": "deleteConversation",
    "group": "Conversation",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant de la conversation</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/channels.php",
    "groupTitle": "Conversation"
  },
  {
    "type": "PUT",
    "url": "/channels/:id",
    "title": "Modifier la conversation",
    "name": "editConversation",
    "group": "Conversation",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant de la conversation</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "label",
            "description": "<p>Etiquette de la conversation</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "topic",
            "description": "<p>Sujet de la conversation</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "channel",
            "description": "<p>La conversation modifiée</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/channels.php",
    "groupTitle": "Conversation"
  },
  {
    "type": "GET",
    "url": "/channels/:id",
    "title": "Une conversation",
    "name": "getConversation",
    "group": "Conversation",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant de la conversation</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "channel",
            "description": "<p>La conversation</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/channels.php",
    "groupTitle": "Conversation"
  },
  {
    "type": "GET",
    "url": "/channels",
    "title": "Liste des conversations",
    "name": "getConversations",
    "group": "Conversation",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "channels",
            "description": "<p>Les conversations</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/channels.php",
    "groupTitle": "Conversation"
  },
  {
    "type": "POST",
    "url": "/channels",
    "title": "Poster une conversation",
    "name": "setConversation",
    "group": "Conversation",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "label",
            "description": "<p>Etiquette de la conversation</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "topic",
            "description": "<p>Sujet de la conversation</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "channel",
            "description": "<p>La conversation créé</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/channels.php",
    "groupTitle": "Conversation"
  },
  {
    "type": "DELETE",
    "url": "/members/:id",
    "title": "Effacer un membre",
    "name": "deleteMembre",
    "group": "Membre",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>L'identifiant du membre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/members.php",
    "groupTitle": "Membre"
  },
  {
    "type": "GET",
    "url": "/members",
    "title": "Liste des membres",
    "name": "getMembres",
    "group": "Membre",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "members",
            "description": "<p>Liste des membres</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/members.php",
    "groupTitle": "Membre"
  },
  {
    "type": "POST",
    "url": "/members",
    "title": "Créer un membre",
    "name": "setMembre",
    "group": "Membre",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fullname",
            "description": "<p>Le nom complet du membre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Le mail du membre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Le mot de passe</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "member",
            "description": "<p>Le membre créé</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/members.php",
    "groupTitle": "Membre"
  },
  {
    "type": "POST",
    "url": "/members/signin",
    "title": "Se connecter",
    "name": "signInMembre",
    "group": "Membre",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Le mail du membre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Le mot de passe</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/members.php",
    "groupTitle": "Membre"
  },
  {
    "type": "DELETE",
    "url": "/members/signout",
    "title": "Se déconnecter",
    "name": "signOutMembre",
    "group": "Membre",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/members.php",
    "groupTitle": "Membre"
  },
  {
    "type": "GET",
    "url": "/members/:id/signedin",
    "title": "Etat de la session",
    "name": "signedInMembre",
    "group": "Membre",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>L'identifiant du membre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/members.php",
    "groupTitle": "Membre"
  },
  {
    "type": "DELETE",
    "url": "/channels/:channel_id/posts/:id",
    "title": "Effacer un message",
    "name": "deleteMessage",
    "group": "Message",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "channel_id",
            "description": "<p>Identifiant de la conversation</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant du message</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/posts.php",
    "groupTitle": "Message"
  },
  {
    "type": "PUT",
    "url": "/channels/:channel_id/posts/:id",
    "title": "Editer un message",
    "name": "editMessage",
    "group": "Message",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "channel_id",
            "description": "<p>Identifiant de la conversation</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant du message</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/posts.php",
    "groupTitle": "Message"
  },
  {
    "type": "GET",
    "url": "/channels/:channel_id/posts/:id",
    "title": "Récupérer un message",
    "name": "getMessage",
    "group": "Message",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "channel_id",
            "description": "<p>Identifiant de la conversation</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant du message</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/posts.php",
    "groupTitle": "Message"
  },
  {
    "type": "PUT",
    "url": "/channels/:channel_id/posts/:id",
    "title": "Récupérer les messages d'une conversation",
    "name": "getMessages",
    "group": "Message",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "channel_id",
            "description": "<p>Identifiant de la conversation</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/posts.php",
    "groupTitle": "Message"
  },
  {
    "type": "POST",
    "url": "/channels/:channel_id/posts/:id",
    "title": "Poster un message",
    "name": "setMessage",
    "group": "Message",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "channel_id",
            "description": "<p>Identifiant de la conversation</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "member_id",
            "description": "<p>Identifiant de l'auteur</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Contenu du message</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "session_token",
            "description": "<p>Le token de session</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "post",
            "description": "<p>Le message posté</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/posts.php",
    "groupTitle": "Message"
  }
] });
