<?php

namespace Controller;

use Model\UtilisateursModel;
use W\Security\AuthentificationModel;

class UserController extends BaseController
{
	/**
	 * Cette fonction sert à afficher la liste des utilisateurs
	 */
	public function listUsers() {
//		$usersList = array(
//			'Googleman', 'Pausewoman', 'Pauseman', 'Roland'
//		);
		
		/*
		 * Ici j'instancie depuis l'action du contrôleur un modèle d'utilisateurs
		 * pour pouvoir accéder à la liste des utilisateurs
		 */
		$usersModel = new UtilisateursModel();
		
		$usersList = $usersModel->findAll();
		
		// la ligne suivante affiche la vue présente dans app/Views/users/list.php
		// et y injecte le tableau $usersList sous un nouveau nom $listUsers
		$this->show('users/list', array('listUsers' => $usersList));
	}
	
	public function login() {
//		 on va utiliser le model d'Authentification et plus particulièrement
//		 la méthode isValidLoginInfos à laquelle on passera en param
//		 le pseudo/email et le password envoyés en post par l'utilisateur
//		 une fois cette vérification faite, on récupère l'utilisateur en bdd
//		 on le connecte et on le redirige vers la page d'accueil
		if( !empty($_POST)) {
			// je vérifie la non-vacuité du pseudo en POST
			if( empty($_POST['pseudo'])) {
				// si le pseudo est vide on ajoute un message d'erreur
			}
			// je vérifie la non-vacuité du mot de passe en POST
			if( empty($_POST['mot_de_passe'])) {
				// si le mot de passe est vide on ajoute un message d'erreur
			}
			
			$auth = new AuthentificationModel();
			
			if( !empty($_POST['pseudo']) && !empty($_POST['mot_de_passe'])) {
				// vérification de l'existence de l'utilisateur
				$idUser = $auth->isValidLoginInfo($_POST['pseudo'], $_POST['mot_de_passe']);
				
				// si l'utilisateur existe bel et bien...
				if($idUser !== 0){
					$utilisateurModel = new UtilisateursModel();
					
					// ... je récupère les infos de l'utilisateur et je m'en
					// sers pour le connecter au site à l'aide de $auth->logUserIn
					$userInfos = $utilisateurModel->find($idUser);
					$auth->logUserIn($userInfos);
					
					// une fois l'utilisateur connecté, je le redirige vers l'accueil
					$this->redirectToRoute('default_home');
				} else {
					// les infos de connexion sont incorrectes, on avertit 
					// l'utilisateur
				}
				
			}
			
		}
		
		$this->show('users/login', array('datas' => isset($_POST) ? $_POST : array()));
	}
	
	public function logout() {
		$auth = new AuthentificationModel();
		$auth->logUserOut();
		$this->redirectToRoute('login');
	}
}