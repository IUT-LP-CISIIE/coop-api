#API
GET/api/ping
Description : Permet de savoir si le service est disponible.
Params : Aucun paramètre supplémentaire requis


POST/api/members
Description : Permet de créer un membre de l'équipe (inscription).
Params : {"fullname": ..., email": ..., "password": ...}


POST/api/members/signin
Description : Permet de connecter un membre de l'équipe.
Params : {"email": ..., "password": ...}


GET/api/members/:id/signedin?token=:token
Description : Retourne les données du membre si celui-ci est bien connecté.
Params : Aucun paramètre supplémentaire requis


DELETE/api/members/signout?token=:token
Description : Permet de déconnecter un membre de l'équipe.
Params : Aucun paramètre supplémentaire requis


GET/api/members?token=:token
Description : Retourne la liste des membres de l'équipe.
Params : Aucun paramètre supplémentaire requis


DELETE/api/members/:id?token=:token
Description : Permet de supprimer le membre de l'équipe (:id).
Params : Aucun paramètre supplémentaire requis


GET/api/channels?token=:token
Description : Permet de récupérer la liste des channels.
Params : Aucun paramètre supplémentaire requis


POST/api/channels?token=:token
Description : Permet de créer un nouveau channel.
Params : {"label": ... , "topic": ...}


GET/api/channels/:id?token=:token
Description : Permet de récupérer le channel (:id).
Params : Aucun paramètre supplémentaire requis


PUT | PATCH/api/channels/:id?token=:token
Description : Permet de mettre à jour le channel (:id).
Params : {"label": ..., "topic": ...}


DELETE/api/channels/:id?token=:token
Description : Permet de supprimer le channel (:id).
Params : Aucun paramètre supplémentaire requis


GET/api/channels/:channel_id/posts?token=:token
Description : Permet de récupérer les posts du channel (:channel_id).
Params : Aucun paramètre supplémentaire requis


POST/api/channels/:channel_id/posts?token=:token
Description : Permet de créer un post pour le channel (:channel_id).
Params : {"message": ...}


GET/api/channels/:channel_id/posts/:id?token=:token
Description : Permet de récupérer le post (:id) du channel (:channel_id).
Params : Aucun paramètre supplémentaire requis


PUT | PATCH/api/channels/:channel_id/posts/:id?token=:token
Description : Permet de modifier le post (:id) pour le channel (:channel_id).
Params : {"message": ...}


DELETE/api/channels/:channel_id/posts/:id?token=:token
Description : Permet de supprimer le post (:id) du channel (:channel_id).
Params : Aucun paramètre supplémentaire requis

