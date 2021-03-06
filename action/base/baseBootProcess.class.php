<?php
/**
 * category action.
 *
 * @package    dota 2 engine
 * @author     roozbeh baabakaan , baobao
 * @toDo       read https://github.com/roozbeh360/dota-2-engine
 */
 
require_once 'build/coreBootProcess.class.php' ;

abstract class BaseDoProcess extends coreBootProcess
{
	public function fetchMatchDetailsById($match_id)
	{
		
		if(!$match_id) return false ;
		
		// request match details using api
		$query = config::$api_url.config::$api_dota_name.'/'.config::$api_match_details.'/'.config::$api_version[0].'/?'.'key='.config::$api_key.'&match_id='.(int)$match_id;
		
		$match_result = self::buildMatchDetails($query) ;
		
		return $match_result ;
	} // fetchMatchById
	
	public function fetchPlayersSummariesById($steamids)
	{
		$query = config::$api_url.config::$api_steamuser_name.'/'.config::$api_player_summaries.'/'.config::$api_version[1].'/?'.'key='.config::$api_key.'&steamids='.$steamids;
		return self::buildPlayerSummaries($query) ;
	}
	
	//match history methods
	//full support for that needed 
	
	public function fetchMatchHistoryByPlayerName($player_name,$start_at_match_id = null,$matches_requested = null)
	{
		$query = self::buildMatchHistoryQuery($player_name,null,null,null,null,null,null,$start_at_match_id,$matches_requested);
		return self::buildMatchHistory($query) ;
	}
	
	public function fetchMatchHistoryByAccountId($account_id,$start_at_match_id = null,$matches_requested = null)
	{
		$query = self::buildMatchHistoryQuery(null,binaryConvert::make64bit($account_id),null,null,null,null,null,$start_at_match_id,$matches_requested);
		return self::buildMatchHistory($query) ;
	}
	
	public function fetchMatchHistoryByHeroId($hero_id,$start_at_match_id = null,$matches_requested = null)
	{
		$query = self::buildMatchHistoryQuery(null,null,$hero_id,null,null,null,null,$start_at_match_id,$matches_requested);
		return self::buildMatchHistory($query) ;
	}
	
	public function fetchMatchHistoryBySkill($skill,$start_at_match_id = null,$matches_requested = null)
	{
		$query = self::buildMatchHistoryQuery(null,null,null,$skill,null,null,null,$start_at_match_id,$matches_requested);
		return self::buildMatchHistory($query) ;
	}
	
	public function fetchMatchHistoryByDate($date_min,$date_max,$start_at_match_id = null,$matches_requested = null)
	{
		$query = self::buildMatchHistoryQuery(null,null,null,null,$date_min,$date_max,null,$start_at_match_id,$matches_requested);
		return self::buildMatchHistory($query) ;
	}
	
	public function fetchMatchHistoryByDateMin($date_min,$start_at_match_id = null,$matches_requested = null)
	{
		$query = self::buildMatchHistoryQuery(null,null,null,null,$date_min,null,null,$start_at_match_id,$matches_requested);
		return self::buildMatchHistory($query) ;
	}
	
	public function fetchMatchHistoryByDateMax($date_max,$start_at_match_id = null,$matches_requested = null)
	{
		$query = self::buildMatchHistoryQuery(null,null,null,null,null,$date_max,null,$start_at_match_id,$matches_requested);
		return self::buildMatchHistory($query) ;
	}
	
	public function fetchMatchHistoryByLeagueId($league_id,$start_at_match_id = null,$matches_requested = null)
	{
		$query = self::buildMatchHistoryQuery(null,null,null,null,null,null,$league_id,$start_at_match_id,$matches_requested);
		return self::buildMatchHistory($query) ;
	} 
	
	public function fetchMatchHistoryBySequenceNum($matches_requested = null,$start_at_match_seq_num = null)
	{
		$query = config::$api_url.config::$api_dota_name.'/'.config::$api_match_history_by_sequenceNum.'/'.config::$api_version[0].'/?'.'key='.config::$api_key;
		if($matches_requested) $query .= '&matches_requested='.$matches_requested;
		if($start_at_match_seq_num) $query .= '&start_at_match_seq_num='.$start_at_match_seq_num;
		return self::buildMatchHistory($query) ;
	} 
	
	public function fetchLeagueListing()
	{		
		// request league listing using api
		$query = config::$api_url.config::$api_dota_name.'/'.config::$api_league_listing.'/'.config::$api_version[0].'/?'.'key='.config::$api_key;
		return self::buildLeagueListing($query) ;
	}
	
	public function fetchLiveLeagueGames()
	{		
		// request league listing using api
		$query = config::$api_url.config::$api_dota_name.'/'.config::$api_live_league_games.'/'.config::$api_version[0].'/?'.'key='.config::$api_key;
		return self::buildLiveLeagueGames($query) ;
	}
	
	public function fetchScheduledLeagueGames($date_min=false,$date_max=false)
	{		
		// request league listing using api
		$query = config::$api_url.config::$api_dota_name.'/'.config::$api_scheduled_league_games.'/'.config::$api_version[0].'/?'.'key='.config::$api_key;
		if($date_min) $query.'&date_min='.$date_min ;
		if($date_max) $query.'&date_max='.$date_max ;
		
		return self::buildScheduledLeagueGames($query) ;
	}
	
	public function fetchTeamInfoByTeamID($start_at_team_id =false,$start_at_team_id =false)
	{		
		// request league listing using api
		$query = config::$api_url.config::$api_dota_name.'/'.config::$api_team_info_by_team_id.'/'.config::$api_version[0].'/?'.'key='.config::$api_key;
		if($start_at_team_id) $query.'&start_at_team_id='.$start_at_team_id ;
		if($start_at_team_id) $query.'&start_at_team_id='.$start_at_team_id ;
		
		return self::buildTeamInfoByTeamID($query) ;
	}
}
